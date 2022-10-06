<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => "https://static.packt-cdn.com/products/".$this->isbn13."/cover/smaller",
            'url' => $this->url,
            'authors' => $this->getAuthors($this->authors),
            'publication_date' => Carbon::parse($this->publication_date)->format('M Y'),
            'length' => $this->length,
            'pages' => $this->pages
        ];
    }

    /**
     * @param $authors
     * @return array
     */
    public function getAuthors($authors)
    {
        $authors = json_decode($authors);
        $authorNames = [];
        foreach ($authors as $author) {
            $authorNames[] = $author->name;
        }
        return $authorNames;
    }
}
