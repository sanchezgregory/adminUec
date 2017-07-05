<?php

namespace App\Http\Controllers;

use App\Student;
use PDF;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function pdf($id)
    {
        $students = Student::with('person')->where('curse_id',$id)->get();
        $pdf = PDF::loadView('pdf/sections', compact('students'));
        return $pdf->stream();
    }
}
