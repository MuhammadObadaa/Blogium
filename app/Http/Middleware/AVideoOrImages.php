<?php

namespace App\Http\Middleware;

use App\Traits\HttpResponses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AVideoOrImages
{
    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->has('media'))
            return $next($request);

        $videoCount = 0;
        $imageCount = 0;

        foreach($request->file('media') as $file){
            if(explode('/',$file->getMimeType())[0] === 'video'){
                $videoCount++;
            }elseif(explode('/',$file->getMimeType())[0] === 'image'){
                $imageCount++;
            }else{
                $errors = (object)array('media.*' => ['one video or multiple images only']);

                return redirect()->back()->withErrors($errors);
            }
        }

        if($videoCount > 1)
        {
            $errors = (object)array('media.*' => ['one video at most']);

            return redirect()->back()->withErrors($errors);
        }
        elseif($videoCount == 1 && $imageCount > 0)
        {
            $errors = (object)array('media.*' => ['one video or multiple images only']);

            return redirect()->back()->withErrors($errors);
        }

        return $next($request);
    }
}
