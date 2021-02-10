<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {   
 
        return $user->can('listar productos');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Producto  $producto
     * @return mixed
     */
    public function view(User $user, Producto $producto)
    {
        return $user->can('listar productos');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('crear productos');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Producto  $producto
     * @return mixed
     */
    public function update(User $user, Producto $producto)
    {
        return $user->can('actualizar productos');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Producto  $producto
     * @return mixed
     */
    public function delete(User $user, Producto $producto)
    {
        return $user->can('eliminar productos');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Producto  $producto
     * @return mixed
     */
    public function restore(User $user, Producto $producto)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Producto  $producto
     * @return mixed
     */
    public function forceDelete(User $user, Producto $producto)
    {
        //
    }
}
