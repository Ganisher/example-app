<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends AppBaseController
{
    /**
     * @var $postRepository PostRepository
     */
    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepo
     */
    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $posts = $this->postRepository->all();

        return $this->sendResponse($posts, __('Записи успешно получены'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError(__('Запись не найдена'), 404);
        }

        return $this->sendResponse($post, __('Запись успешно получена'));
    }


    public function update($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'title' => 'filled',
            'content' => 'filled',
        ]);

        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError(__('Запись не найдена'), 404);
        }

        $post = $this->postRepository->update($request->all(), $id);

        return $this->sendResponse($post, __('Запись успешно обновлена'));
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            return $this->sendError(__('Запись не найдена'), 404);
        }

        $this->postRepository->delete($id);

        return $this->sendSuccess(__('Запись успешно удалена'));
    }
}
