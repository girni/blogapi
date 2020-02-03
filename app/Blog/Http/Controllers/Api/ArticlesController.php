<?php

namespace BlogApi\Blog\Http\Controllers\Api;

use BlogApi\Blog\File\FileManager;
use BlogApi\Blog\Http\Requests\ArticleUpdateRequest;
use BlogApi\Blog\Http\Resources\Article as ArticleResource;
use BlogApi\Blog\Http\Resources\Articles;
use BlogApi\Blog\Model\Article;
use BlogApi\Blog\Repositories\ArticleRepositoryInterface;
use BlogApi\Core\Http\Controllers\Controller;
use BlogApi\Blog\Http\Requests\ArticleCreateRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

final class ArticlesController extends Controller
{
    /**
     * @var ArticleRepositoryInterface
     */
    private ArticleRepositoryInterface $articleRepository;

    /**
     * @var FileManager
     */
    private FileManager $fileManager;

    /**
     * @var ResponseFactory
     */
    private ResponseFactory $responseFactory;

    /**
     * ArticlesController constructor.
     * @param ArticleRepositoryInterface $articleRepository
     * @param FileManager $fileManager
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        FileManager $fileManager,
        ResponseFactory $responseFactory
    )
    {
        $this->articleRepository = $articleRepository;
        $this->fileManager = $fileManager;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param Request $request
     * @return Articles
     */
    public function index(Request $request): Articles
    {
        $articles = $this->articleRepository->findLatest($request->get('limit', null));

        return new Articles($articles);
    }

    /**
     * @param ArticleCreateRequest $request
     * @return Article
     */
    public function create(ArticleCreateRequest $request): Article
    {
        $image = $this->fileManager->store($request->file('image'));

        $article = $this->articleRepository->create(array_merge(
            $request->except('image'),
            [
                'image' => $image,
                'user_id' => auth()->id(),
                'slug' => Str::slug($request->get('title'))
            ]
        ));

        return new ArticleResource($article);
    }

    /**
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * @return ArticleResource
     * @throws \BlogApi\Core\Exceptions\AppException
     */
    public function update(ArticleUpdateRequest $request, Article $article): ArticleResource
    {
        $image = $article->image;

        if($request->file('image') instanceof UploadedFile){
            $image = $this->fileManager->replaceFiles($image, $request->file('image'));
        }

        $article = $this->articleRepository->update($article, array_merge(
            $request->except('image'),
            [
                'image' => $image,
                'user_id' => auth()->id(),
                'slug' => Str::slug($request->get('title'))
            ]
        ));

        return new ArticleResource($article);
    }

    /**
     * @param Article $article
     * @return JsonResponse
     */
    public function delete(Article $article): JsonResponse
    {
        $this->fileManager->delete($article->image);
        $this->articleRepository->delete($article);

        return $this->responseFactory->json(['success' => true], Response::HTTP_OK);
    }
}