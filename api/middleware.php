<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

/**
 * JSON Body Parser Middleware
 * 
 * This middleware parses JSON request body and attaches it to the request as a `parsedBody` attribute
 * 
 * @see https://www.slimframework.com/docs/v4/objects/request.html#the-request-body
 */
class JsonBodyParserMiddleware implements MiddlewareInterface
{
    /**
     * Parse JSON request body and attach it to the request as a `parsedBody` attribute
     *
     * @param Request $request PSR-7 request
     * @param RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $contentType = $request->getHeaderLine('Content-Type');

        if (strstr($contentType, 'application/json')) {
            $contents = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request = $request->withParsedBody($contents);
            }
        }

        return $handler->handle($request);
    }
}


/**
 * Custom Middleware
 */
$config_mw = function (Request $request, RequestHandler $handler) {
    global $g5;

    $sql = "SELECT * FROM {$g5['config_table']}";
    $config = sql_fetch($sql);

    $request = $request->withAttribute('config', $config);
    $response = $handler->handle($request);

    return $response;
};