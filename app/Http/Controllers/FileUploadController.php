<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Document;
use App\Models\Application;


class FileUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
       
        // Set Upload directory
        $upload_directory = 'uploads/'. Auth::user()->uuid;

        echo "DOCUMENT TYPE : ".$request->doctype."<br />";
        // exit;
    
        // Get the uploaded file type
        if ($request->doctype == "D01"){
            // Check the accepted mimes type.
            $request->validate([
                'uploadfile_mykad'=>'required|mimes:jpeg,png,bmp,pdf,docx,doc|max:2048'
            ]);

            $nmykad = str_replace("-", "", trim(Auth::User()->mykad));

            // echo Auth::User()->mykad." -- ".$nmykad;exit;

            $file = $request->file('uploadfile_mykad');

            $filename = 'D01_'.$nmykad.'_' . $file->getClientOriginalName();

            $message_hdr = 'message_mykad';
        }elseif ($request->doctype == "D02"){
            // Check the accepted mimes type.
            $request->validate([
                'uploadfile_passport'=>'required|mimes:jpeg,png,bmp,jpg|max:2048'
            ]);

            $nmykad = str_replace("-", "", trim(Auth::User()->mykad));

            $file = $request->file('uploadfile_passport');
            $filename = 'D02_'.$nmykad. '_' . $file->getClientOriginalName();

            $message_hdr = 'message_passport';
        }elseif ($request->doctype == "D03"){
            // Check the accepted mimes type.
            $request->validate([
                'uploadfile_transcript'=>'required|mimes:pdf,docx,doc|max:2048'
            ]);

            $nmykad = str_replace("-", "", trim(Auth::User()->mykad));

            $file = $request->file('uploadfile_transcript');
            $filename = 'D03_'.$nmykad. '_' . $file->getClientOriginalName();

            $message_hdr = 'message_transcript';
        }elseif ($request->doctype == "D04"){
            // Check the accepted mimes type.
            $request->validate([
                'uploadfile_offerletter'=>'required|mimes:pdf,docx,doc|max:2048'
            ]);

            $nmykad = str_replace("-", "", trim(Auth::User()->mykad));

            $file = $request->file('uploadfile_offerletter');
            $filename = 'D04_'.$nmykad. '_' . $file->getClientOriginalName();

            $message_hdr = 'message_offerletter';
        }else if ($request->doctype == "D05"){
            // Check the accepted mimes type.
            $request->validate([
                'uploadfile_curriculumvitae'=>'required|mimes:pdf,docx,doc|max:2048'
            ]);

            $nmykad = str_replace("-", "", trim(Auth::User()->mykad));

            $file = $request->file('uploadfile_curriculumvitae');
            $filename = 'D05_'.$nmykad. '_' . $file->getClientOriginalName();

            $message_hdr = 'message_curriculumvitae';
        }else if ($request->doctype == "D06"){
            // Check the accepted mimes type.
            $request->validate([
                'uploadfile_employment'=>'required|mimes:pdf,docx,doc|max:2048'
            ]);

            $nmykad = str_replace("-", "", trim(Auth::User()->mykad));
            
            $file = $request->file('uploadfile_employment');
            $filename = 'D06_'.$nmykad. '_' . $file->getClientOriginalName();

            $message_hdr = 'message_employment';
        }

        echo "filename :" . $filename ."<br />";
        // exit;

        // Check if record existed
        // Get the uploaded document data
        $documents = Document::where('user_id', '=', Auth::user()->id)
        ->where('filetype', '=', $request->doctype)->get();
        
        // Delete the existing uploaded document
        foreach($documents as $document){
            echo "document file name :" . $document->filename;
            // exit; 

            if ($document->filename){
                $uploadedfile = public_path("storage/".$document->filepath ."/". $document->filename);

                // Check for existing file and delete it 
                if(File::exists($uploadedfile))
                    File::delete($uploadedfile);

                // Delete the database entry for the file.
                Document::where('user_id', '=', Auth::user()->id)->where('filetype', '=', $request->doctype)->delete();
            }
        }   
        
        // Upload the file to their respective folder
        $filepath = $file->storeAs($upload_directory, $filename, 'public');

        // Generate new Uuid
        $docUuid = Str::uuid();
        

        echo "FileName : ".$filename."<br />";
        echo "FilePath : ".$upload_directory;
        //exit;


        // Insert new file entry in the database
        Document::create([
            'uuid'      => $docUuid,
            'user_id'   => Auth::user()->id,
            'filetype'  => $request->doctype,
            'filename'  => $filename,
            'filepath'  => $upload_directory
        ]);

        // Count number of files uploaded
        // $docCount = DB::table('documents')->selectRaw('*, count(*)')->where('user_id', '=', Auth::user()->id);
        $docCount = Document::where('user_id', '=', Auth::user()->id)->get();
        $countofdocs = count($docCount);

        echo "document count :".$countofdocs;

        if($countofdocs == 6){
            $application = Application::updateOrCreate(
                ['user_id' => Auth::user()->id],
                ['tab07' => "1"]
            );
        }

        return redirect()->route('apply.index', ['step' => 'document'])
        ->with($message_hdr, 'File uploaded successfully')
        ->with('fileName', $filename);
    }
}
