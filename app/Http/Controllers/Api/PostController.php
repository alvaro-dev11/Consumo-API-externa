<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    protected $urlApiExterna = 'https://jsonplaceholder.typicode.com';

    public function index()
    {
        /**
         * Hacer una petición con método GET a la API externa.
         * Guardamos la respuesta en una variable.
         * Retornamos la respuesta en formato JSON.
         */
        $response = Http::get($this->urlApiExterna . '/posts');
        return $response->json();
    }

    public function store(Request $request)
    {
        /**
         * Hacer una petición con método POST a la API externa.
         * Como segundo parámetro le pasamos la request es decir los campos que se necesita para crear un nuevo recurso.
         * Guardamos la respuesta en una variable.
         * Retornamos la respuesta en formato JSON o podemos personalizar nuestra respuesta.
         */
        $response = Http::post($this->urlApiExterna . '/posts', $request);
        $data = [
            'status' => $response->status(),
            'message' => 'Post creado con éxito',
            'data' => $response->json()
        ];
        return $data;
    }

    public function show(string $id)
    {
        /**
         * Hacer una petición con método GET a la API externa.
         * Le pasamos el parámetro id a la API externa.
         * Guardamos la respuesta en una variable.
         * Guardamos la respuesta en formato JSON en otra variable.
         * Retornamos solamente el título de la respuesta, es una manera de personalizar la respuesta de mi API.
         */
        $response = Http::get($this->urlApiExterna . '/posts/' . $id);
        $data = $response->json();
        return ['Título' => $data['title']];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /**
         * Hacer una petición con método PUT a la API externa.
         * Le pasamos el parámetro id a la API externa
         * Como segundo parámetro le pasamos la request es decir los campos que se necesita para actualizar el recurso existente.
         * Guardamos la respuesta en una variable.
         * Retornamos la respuesta en formato JSON o podemos personalizar nuestra respuesta.
         */
        // $response = Http::put($this->urlApiExterna . '/posts/' . $id, $request);
        $response = Http::patch($this->urlApiExterna . '/posts/' . $id, $request);
        $data = [
            'status' => $response->status(),
            'message' => 'Post actualizado con éxito',
            'data' => $response->json()
        ];
        return $data;
    }

    public function destroy(string $id)
    {
        /**
         * Hacer una petición con método DELETE a la API externa.
         * Le pasamos el parámetro id a la API externa.
         * Guardamos la respuesta en una variable.
         * Retornamos la respuesta en formato JSON o podemos personalizar nuestra respuesta.
         */
        $response = Http::delete($this->urlApiExterna . '/posts/' . $id);
        $data = [
            'status' => $response->status(),
            'message' => 'Post eliminado con éxito',
        ];
        if ($response->successful()) {
            return $data;
        } else {
            return ['message' => 'Error al eliminar'];
        }
    }

    public function filteringResources(string $id)
    {
        $response = Http::get($this->urlApiExterna . '/posts?userId=' . $id);
        return $response->json();
    }

    public function listingNestedResources(string $id)
    {
        $response = Http::get($this->urlApiExterna . '/posts/' . $id . '/comments');
        return $response->json();
    }
}
