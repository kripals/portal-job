<?php

namespace App\Modules\Models\Education;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Models\Candidate\Candidate;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'ref_id', 'candidate_id', 'qualification_level', 'program_name', 'education_board_id',
        'institute_name', 'passing_year', 'is_current', 'marks_obtained', 'marks_type'
    ];

    protected $appends = [
        'marks_obtained_type'
    ];

    function getMarksObtainedTypeAttribute()
    {
        if ($this->marks_type == 'percent')
            $type = '%';
        else
            $type = strtoupper($this->marks_type);

        return $this->marks_obtained . ' ' . ucwords($type);
    }

    function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    function board()
    {
        return $this->belongsTo(EducationBoard::class, 'education_board_id');
    }
}
