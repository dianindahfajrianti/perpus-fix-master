<?php 
foreach($book as $b){
    $books->title = $b->title;
    $books->desc = $b->desc; 
    $books->filename = $b->filename;
    $books->filetype = $b->filetype;
    $books->clicked_time = $b->clicked_time;
    $books->school_id=$b->school_id;
    $books->edu_id=$b->edu_id;
    $books->grade_id=$b->grade_id;
    $books->major_id->$b->major_id;
    $books->sub_id=$b->sub_id;
    $books->published_year=$b->published_year;
    $books->publisher=$b->publisher;
    $books->author=$b->author;
    $books->save();
};
