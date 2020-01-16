<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/01/20
 * Time: 07:26 م
 */

namespace App\Controller;


use App\Service\UserService;
use FOS\RestBundle\FOSRestBundle;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\User;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController
{

    /**
     * @Rest\Get("/api/users")
     * @SWG\Response(
     *     response=200,
     *     description="Returns list of users",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class, groups={"Data"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="provider",
     *     in="query",
     *     type="string",
     *     description="The data provider ex. DataProviderX"
     * )
     * @SWG\Parameter(
     *     name="statusCode",
     *     in="query",
     *     type="string",
     *     description="Status of user ex. authorised"
     * )
     * @SWG\Parameter(
     *     name="balanceMin",
     *     in="query",
     *     type="number",
     *     description="minimum balance of user"
     * )
     * @SWG\Parameter(
     *     name="balanceMax",
     *     in="query",
     *     type="number",
     *     description="maximum balance of user"
     * )
     * @param Request $request
     * @param UserService $userService
     * @param SerializerInterface $serializer
     *
     * @return Response
     */
    public function index(Request $request, UserService $userService, SerializerInterface $serializer)
    {
        $users = $userService->getBy($request->query->all());

        $serializerContext =  new SerializationContext();
        $serializerContext->setGroups(['Data']);

        return new Response($serializer->serialize($users, 'json', $serializerContext));
    }
}