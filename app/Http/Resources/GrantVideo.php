<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GrantVideo extends JsonResource
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
            'thumb' => $this->thumb,
            'frame' => $this->frame,
            'clicked_time' => $this->clicked_time,
            'edu_id' => $this->edu_id,
            'grade_id' => $this->grade_id,
            'grade_name' => $this->grades->grade_name,
            'major_id' => $this->major_id,
            'major_name' => $this->majors->maj_name,
            'sub_id' => $this->sub_id,
            'sbj_name' => $this->subjects->sbj_name,
            'creator' => $this->creator,
            'granted_at' => $this->schools[0]->pivot->created_at
        ];
    }
}
