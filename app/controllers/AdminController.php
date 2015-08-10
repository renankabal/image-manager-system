<?php
/**
 * Created by PhpStorm.
 * User: Lyudmil
 * Date: 15.12.2014
 * Time: 13:54
 */

class AdminController extends BaseController{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {

        return View::make('admin.index');

    }
}