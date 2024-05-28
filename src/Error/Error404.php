<?php
/**
 * MIT License
 *
 * Copyright (c) 2024-Present Kevin Traini
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

declare(strict_types=1);

namespace Archict\Archict\Error;

use Archict\Router\ResponseHandler;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Error404 implements ResponseHandler
{
    public function handleResponse(ResponseInterface $response, ServerRequestInterface $request): ResponseInterface
    {
        $factory = new HttpFactory();
        $path    = $request->getUri()->getPath();
        return $response->withBody(
            $factory->createStream(
                <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Page not found</title>
                <style>
                body {
                    width: 100%;
                    height: 100vh;
                    font-size: 2em;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                </style>
            </head>
            <body>
                <span>Page '<code>$path</code>' not found!</span>
            </body>
            </html>
            HTML
            )
        );
    }
}
