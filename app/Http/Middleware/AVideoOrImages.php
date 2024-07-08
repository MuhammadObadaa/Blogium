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
                return $this->error('Media can be either a video or images',402);
            }
        }

        if($videoCount > 1)
            return $this->error('Multiple videos in blog are previnted',402);
        elseif($videoCount == 1 && $imageCount > 0)
            return $this->error('Media can be either a video or images',402);

        return $next($request);
    }
}
