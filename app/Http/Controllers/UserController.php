<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;



    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     tags={"Users"},
     *      @OA\Response(response=200, description="All Users" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearerAuth":{}}}
     * )
     */

   /**
    * @OA\Post(
        *     path="/api/users",
        *     summary="Create a new user",
        *     description="Create a new user with the provided username, email, and password",
        *     tags={"Users"},
        *     @OA\RequestBody(
        *         required=true,
        *         @OA\JsonContent(
        *             required={"name", "email", "password"},
        *             @OA\Property(property="name", type="string", example="john_doe"),
        *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
        *             @OA\Property(property="password", type="string", example="password123")
        *         )
        *     ),
        *    @OA\Response(response=200, description="Create New User" ),
       *     @OA\Response(response=400, description="Bad request"),
       *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */

   /**
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="Get a specific user",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user to retrieve",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="User Detail" ),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=404, description="Resource Not Found"),
 *     security={{"bearerAuth":{}}}
 * )
 */
 /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Update a specific user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
        * @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 type="object",
    *                  @OA\Property(property="name", type="string", example="john_doe"),
    *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
    *             @OA\Property(property="password", type="string", example="password123")
    *             )
    *         )
    *     ),
     *     @OA\Response(response=200, description="Delate user" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearerAuth":{}}}
     * )
     */

       /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Delete a specific user",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(response=200, description="Delete User"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     security={{"bearerAuth":{}}}
     * )
     */

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        $user=User::create($request->all());
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show($id) // usser chi tieets
    {
        //
        $user= User::findOrFail($id);
        return response()->json($user);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user= User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user=User::findOrFail($id);
        $user->delete();
        return "Delete Success";
    }
}
