<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{
    public function findAllStatus(){
        $statuses = Status::all();
        $data = [
            "message" => "All Statuses",
            "data" => $statuses
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request){
        if (!$request->all()) {
            $data = ["message" => "error", "info" => 'No Content'];
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'status_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => "error", "info" => $validator->errors()->getMessages()], 400);
        }

        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $status_id = $request->status_id;
        $in_date_at = $request->in_date_at;
        $out_date_at = $request->out_date_at;

        $patients = Patients::create([
            "name" => $name,
            "phone" => $phone,
            "address" => $address,
            "status_id" => $status_id,
            "in_date_at" => $in_date_at,
            "out_date_at" => $out_date_at
        ]);

        $data = [
            "message" => "Patients successfully added!",
            "data" => $patients
        ];
        
        return response()->json($data, 201);
    }

    public function index(){
        $patients = Patients::all();
        $data = [
            "message" => "All Patients",
            "data" => $patients
        ];

        return response()->json($data, 200);
    }

    public function show($id){

        $patient = Patients::find($id);
        if ($patient) {
            $data = [
            "message" => "Patient Detail",
            "data" => $patient
        ];
        return response()->json($data, 200);

        } else{

            $data = [
            "message" => "error",
            "info" => 'Patient Detail Not Found'
        ];
        return response()->json($data, 404);

        }
    }

    public function search($name){

        $patients = Patients::where('name', 'like', '%' . $name . '%')->get();
        $data = [
            "message" => "Patients All",
            "data" => $patients
        ];

        return response()->json($data, 200);
    }

    public function updatedatapatient(Request $request, $id){

        if (!$request->all()) {
            $data = [ "message" => "error", "info" => 'No Content'];
            return response()->json($data, 204);
        }

        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $status_id = $request->status_id;
        $in_date_at = $request->in_date_at;
        $out_date_at = $request->out_date_at;

        $patient = Patients::find($id);
        if ($patient) {
            $patient->update([
                "name" => $name != null ? $name : $patient->name,
                "phone" => $phone != null ? $phone : $patient->phone,
                "address" => $address != null ? $address : $patient->address,
                "status_id" => $status_id != null ? $status_id : $patient->status_id,
                "in_date_at" => $in_date_at != null ? $in_date_at : $patient->in_date_at,
                "out_date_at" => $out_date_at != null ? $out_date_at : $patient->out_date_at,
            ]);
            $data = [
                "message" => "Patient successfuly updated!",
                "data" => $patient
            ];
            return response()->json($data, 200);

        } else {
            $data = [
                "message" => "error",
                "info" => 'Patient not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function destroy($id){
        $patients = Patients::find($id);
        if ($patients) {
            $patients->delete();
            $data = [
                "message" => "Patient deleted successfully",
                "data" => $patients
            ];
            return response()->json($data, 200);
        } else {
            return response()->json(["message" => "error", "info" => "Patient not found"], 404);
        }
    }

    private function findbystatus($status){
        $patients = Patients::where('status_id', $status)->get();
        $data = [
            "message" => "Patients by status",
            "data" => $patients
        ];

        return response()->json($data, 200);
    }

    public function statuspositive(){

        return $this->findbystatus(1);

    }

    public function statusrecovered(){

        return $this->findbystatus(2);

    }

    public function statusdead(){

        return $this->findbystatus(3);

    }
}
