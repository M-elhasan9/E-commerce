<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MaterialRequest;
use App\Models\Group;
use App\Models\Material;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Image;
use Prologue\Alerts\Facades\Alert;


/**
 * Class MaterialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MaterialCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Material::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/material');
        CRUD::setEntityNameStrings('المادة', 'المواد');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        if (!backpack_user()->is_admin) {
            $this->crud->addClause('where','materials.user_id','=',backpack_user()->id);
        }

        //CRUD::setFromDb(); // columns


        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_visible',
            'label' => 'عرض العناصر المرئية'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_visible', '1');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'is_available',
            'label' => 'عرض العناصر المتاحة'
        ],
            false,
            function () {
                $this->crud->addClause('where', 'is_available', '1');
            });


        CRUD::addColumn(['name' => 'name', 'type' => 'text', 'label' => 'الاسم']);
        CRUD::addColumn(['name' => 'description', 'type' => 'text', 'label' => 'الوصف']);
        CRUD::addColumn(['name' => 'serial', 'type' => 'text', 'label' => 'الرقم التسلسلي']);

        CRUD::addColumn([
            'name' => 'image', // The db column name
            'label' => "الصورة", // Table column heading
            'type' => 'image',
        ]);

        CRUD::addColumn(['name' => 'cost_price', 'type' => 'number', 'label' => 'سعر التكلفة']);
        CRUD::addColumn(['name' => 'selling_price', 'type' => 'number', 'label' => 'سعر البيع']);
        CRUD::addColumn(['name' => 'group', 'type' => 'select', 'label' => 'المجموعة']);
        CRUD::addColumn(['name' => 'is_visible', 'type' => 'boolean', 'label' => 'مرئية']);
        CRUD::addColumn(['name' => 'is_available', 'type' => 'boolean', 'label' => 'متاحة']);
        CRUD::addColumn(['name' => 'user_id', 'type' => 'text', 'label' => 'المسخدم الذي اضاف المادة']);
        CRUD::addColumn(['name' => 'not', 'type' => 'text', 'label' => 'ملاحظات']);



        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $user = backpack_user();
        if ($user->is_admin) {
            abort(403, "you do not have  the permission to do this!");
        }

        CRUD::setValidation(MaterialRequest::class);

        //CRUD::setFromDb(); // fields

        CRUD::addField(['name' => 'name', 'type' => 'text', 'label' => 'الاسم']);
        CRUD::addField(['name' => 'description', 'type' => 'text', 'label' => 'الوصف']);
        CRUD::addField(['name' => 'serial', 'type' => 'text', 'label' => 'الرقم التسلسلي']);

        CRUD::addField([
            'name' => 'image',
            'label' => 'الصورة',
            'type' => 'image',
        ]);

        CRUD::addField(['name' => 'cost_price', 'type' => 'number', 'label' => 'سعر التكلفة']);
        CRUD::addField(['name' => 'selling_price', 'type' => 'number', 'label' => 'سعر البيع']);

        CRUD::addField(['name' => 'group', 'label' => "المجموعة", 'type' => 'select',
            'entity' => 'group', Group::class => "App\Models\Group",
            'attribute' => 'name', (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),]);

        CRUD::addField(['name' => 'not', 'type' => 'text', 'label' => 'ملاحظات', 'value']);




        $material = new Material;
        $material->user_id = backpack_user();


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }


    protected function setupShowOperation()
    {
        $user = backpack_user();
        if ($user->cannot("view", $this->crud->getCurrentEntry())) {
            abort(403, "you do not have  the permission to do this!");
        }


        CRUD::addColumn(['name' => 'name', 'type' => 'text', 'label' => 'الاسم']);
        CRUD::addColumn(['name' => 'description', 'type' => 'text', 'label' => 'الوصف']);
        CRUD::addColumn(['name' => 'serial', 'type' => 'text', 'label' => 'الرقم التسلسلي']);

        CRUD::addColumn([
            'name' => 'image', // The db column name
            'label' => "الصورة", // Table column heading
            'type' => 'image',
        ]);

        CRUD::addColumn(['name' => 'cost_price', 'type' => 'number', 'label' => 'سعر التكلفة']);
        CRUD::addColumn(['name' => 'selling_price', 'type' => 'number', 'label' => 'سعر البيع']);
        CRUD::addColumn(['name' => 'group', 'type' => 'select', 'label' => 'المجموعة']);
        CRUD::addColumn(['name' => 'is_visible', 'type' => 'boolean', 'label' => 'مرئية']);
        CRUD::addColumn(['name' => 'is_available', 'type' => 'boolean', 'label' => 'متاحة']);

        CRUD::addColumn(['name' => 'user_id', 'type' => 'text', 'label' => 'المسخدم الذي اضاف المادة']);

        CRUD::addColumn(['name' => 'not', 'type' => 'text', 'label' => 'ملاحظات']);


        if ($user->is_admin) {
            $this->crud->addButtonFromView('line', 'show_hide_Material', "toggleVisibility");
        }

        if ($user->can("materialToggleAvailability", $this->crud->getCurrentEntry())) {
            $this->crud->addButtonFromView('line', 'is_available', "toggleAvailability");
        }

    }

    public function materialToggleVisibility($materialId)
    {
        $user = backpack_user();
        if ($user->cannot("materialToggleVisibility", $this->crud->getCurrentEntry())) {
            abort(403, "you do not have  the permission to do this!");
        }

        $material = Material::query()->findOrFail($materialId);
        $material->is_visible = !$material->is_visible;
        $material->save();
        if ($material->is_visible) {
            Alert::success('تم إظهار المادة')->flash();
        } else {
            Alert::error('تم  إخفاء المادة')->flash();
        }
        //Alert::success($material->is_visible ? 'تم إظهار المادة' : 'تم إخفاء المادة')->flash();
        return back();
    }

    public function materialToggleAvailability($materialId)
    {
        $user = backpack_user();
        if ($user->cannot("materialToggleAvailability", $this->crud->getCurrentEntry())) {
            abort(403, "you do not have  the permission to do this!");
        }


        $material = Material::query()->findOrFail($materialId);
        $material->is_available = !$material->is_available;
        $material->save();

        if ($material->is_available) {
            Alert::success('تم إتاحة المادة')->flash();
        } else {
            Alert::error('تم إلغاء إتاحة المادة')->flash();
        }
        //Alert::success($material->is_available ? 'تم إتاحة المادة' : 'تم إلغاء إتاحة المادة')->flash();
        return back();
    }


}
