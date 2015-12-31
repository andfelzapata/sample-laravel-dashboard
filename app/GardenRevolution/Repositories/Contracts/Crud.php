<?php namespace App\GardenRevolution\Repositories\Contracts;

/*
 * Contract for repositories to implement CRUD functionality.
 * @author Alan Ruvalcaba
 * @since 2015-12-28
 */
interface Crud 
{
    function create(array $data);
    function delete($id);
    function update(array $data, $id);
    function find($id, $columns = array('*'));
}
