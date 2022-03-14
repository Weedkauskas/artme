<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagicAddRequest;
use App\Http\Requests\MagicPhraseAddRequest;
use App\Interfaces\MagicServiceInterface;
use Illuminate\Http\Request;

class MagicController extends Controller
{
    private $magicService;

    /* Abstrakcijos dependency infection į construct */
    public function __construct(MagicServiceInterface $magicServiceInterface)
    {
        $this->magicService = $magicServiceInterface;
    }

    /**
     * Welcome page
     * @return \Illuminate\Contracts\View\View
     */

    public function welcome()
    {
        $magic = $this->magicService->getAll();

        return view('welcome', ['magic' => $magic]);
    }

    /**
     * Find magic item by slug
     * @param string $magicSlug
     * @return \Illuminate\Contracts\View\View
     */

    public function find($magicSlug)
    {
        $magic = $this->magicService->findBySlug($magicSlug);

        abort_if(!$magic, 404);

        return view('visualise', [
            'id' => $magic->id,
            'title' => $magic->title,
            'phrases' => $magic->phrases
        ]);
    }


    /**
     * Add a new magic item simple form way
     * @param MagicAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function add(MagicAddRequest $request)
    {
        $this->magicService->add($request->title);

        return redirect()->route('welcome');
    }


    /**
     * Ok, let's add new phase to magic API way
     * @param MagicPhraseAddRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function addPhrase(MagicPhraseAddRequest $request)
    {
        $id = $this->magicService->addPhrase($request->magic_id, $request->phrase, $request->description);

        return response()->json([
            'status' => 'OK',
            'id' => $id,
        ]);
    }

    /**
     * View phrase data APi way
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function viewPhrase($id)
    {
        $data = $this->magicService->viewPhrase($id);

        abort_if(!$data, 404);

        return response()->json([
            'status' => 'OK',
            'data' => $data,
        ]);
    }

    public function deletePhrase($id)
    {
        $delete = $this->magicService->deletePhrase($id);

        return response()->json([
            'status' => 'OK',
            'data' => $delete,
        ]);
    }
}
