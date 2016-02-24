<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
use Response;

class ApiController extends Controller
{

    /**
     * Default status code.
     * Code: 200
     *
     * @var int
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * Return current status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set status code for current response.
     *
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Successful resource creation response.
     * Code: 201
     *
     * @param $message
     *
     * @return mixed
     */
    public function respondCreated($message = 'Resource created')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([

            'message' => $message

        ]);
    }

    /**
     * Accepted request, async.
     * Code: 202
     *
     * @param string $message
     *
     * @return bool
     */
    public function respondAccepted($message= 'Accepted'){

        return $this->setStatusCode(IlluminateResponse::HTTP_ACCEPTED)>respond([

            'message' => $message

        ]);

    }

    /**
     * Invalid client request.
     * Code: 400
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondBadRequest($message = 'Bad Request'){

        return $this->setStatusCode(IlluminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);

    }

    /**
     * Unauthorized request, authentication required or authentication errors.
     * Code: 401
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondUnauthorized($message = 'Unauthorized'){

        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * Authenticated user but not authorized to proceed with request.
     * Code: 403
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondForbidden($message = 'Forbidden'){

        return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }

    /**
     * Requested route not valid or resource does not exist.
     * Code: 404
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message) ;
    }

    /**
     * Data has been deleted or suspended.
     * Code: 410
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondGone($message = 'Gone'){

        return $this->setStatusCode(IlluminateResponse::HTTP_GONE)->respondWithError($message);

    }

    /**
     * Something unexpected happended with the server, API's fault.
     * Code: 500
     *
     * @param string $message
     *
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * Respond with error messages and status code.
     *
     * @param $message
     *
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([

            'error' => [

                'message' => $message,

                'status_code' => $this->getStatusCode()
            ]

        ]);
    }

    /**
     * Return JSON response with status code and optional headers.
     *
     * @param       $data
     * @param array $headers
     *
     * @return mixed
     */
    public function respond($data, $headers = [])
    {

        return Response::json($data, $this->getStatusCode(), $headers);

    }
}
