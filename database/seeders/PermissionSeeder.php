<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin= Role::create(['name' => 'superadmin']);


        //Permission as array
        $permissions =[
              [
                'group_name'=>'dashboard',
                'permissions'=>[
                    'dashboard',

                ]
              ],
              [
                'group_name'=>'admin',
                'permissions'=>[
                    'admins',
                    'admins/create',
                    'admins/edit',
                    'admins/delete',

                ]
              ],
              [
                'group_name'=>'role',
                'permissions'=>[
                    'roles',
                    'roles/create',
                    'roles/edit',
                    'roles/delete',

                ]
              ],
              [
                'group_name'=>'product',
                'permissions'=>[
                    'product',
                    'product-create',
                    'product-store',
                    'product-edit',
                    'product-update',
                    'product-delete',
                    'image-delete',


                ]
              ],
              [
                'group_name'=>'category',
                'permissions'=>[
                    'categories',
                    'categories-create',
                    'categories-store',
                    'categories-edit',
                    'categories-update',
                    'categories-delete',
                    'subcategories-delete',

                ]
              ],
              [
                'group_name'=>'color',
                'permissions'=>[
                    'color',
                    'color-create',
                    'color-edit',
                    'color-update',
                    'color-delete',


                ]
              ],
              [
                'group_name'=>'size',
                'permissions'=>[
                    'size',
                    'size-create',
                    'size-edit',
                    'size-update',
                    'size-delete',

                ]
              ],
              [
                'group_name'=>'recyclebin',
                'permissions'=>[
                    'recyclebin',
                    'product-restore',
                    'product-permanently-delete',
                    'image-restore',
                    'image-permanently-delete',
                    'category-restore',
                    'category-permanently-delete',
                    'subcategory-restore',
                    'subcategory-permanently-delete',
                    'color-restore',
                    'color-permanently-delete',
                    'size-restore',
                    'size-permanently-delete',


                    

                ]
              ],

             

            


            


              

             

             

        ];
        //Create and Assign Permissions
        for($i=0;$i<count($permissions);$i++){
            $permissionGroup=$permissions[$i]['group_name'];
            for($j=0;$j<count($permissions[$i]['permissions']);$j++){
              $permission =Permission::create(['name'=>$permissions[$i]['permissions'][$j],'group_name'=> $permissionGroup]);
              $roleSuperAdmin->givePermissionTo($permission);
              $permission->assignRole($roleSuperAdmin);
            }

        }
    }
}
