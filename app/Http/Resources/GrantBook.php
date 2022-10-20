<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GrantBook extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'desc' => $this->desc,
            'filename' => $this->filename,
            'filetype' => $this->filetype,
            'clicked_time' => $this->clicked_time,
            'edu_id' => $this->edu_id,
            'edu_name' => $this->education->edu_name,
            'grade_id' => $this->grade_id,
            'grade_name' => $this->grades->grade_name,
            'major_id' => $this->major_id,
            'major_name' => $this->majors->maj_name,
            'sub_id' => $this->sub_id,
            'sbj_name' => $this->subjects->sbj_name,
            'published_year' => $this->published_year,
            'publisher' => $this->publisher,
            'author' => $this->author,
            'granted_at' => $this->schools[0]->pivot->created_at
            ];
    }
}
