<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App;
use Faker;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Contacts extends Controller
{
    //
	public function remplir()
	{
		$faker = Faker\Factory::create();

        $limit = 33;
		for ($i = 0; $i < $limit; $i++) {
            DB::table('contacts')->insert([ //,
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'email' => $faker->unique()->email,
                'telephone' => $faker->phoneNumber,
                'service' => $faker->jobTitle,
                'adresse' => $faker->address,
                'cp' => $faker->postcode,
                'ville' => $faker->city,
                'date_naissance' => $faker->dateTimeThisCentury->format('Y-m-d')
            ]);
        }
		return redirect('contacts');
	}
	public function list($status=0)
	{
		$table_contact=DB::table('contacts');
		$contacts=$table_contact->select(['id','prenom','nom','date_naissance','email','telephone','service','adresse','cp','ville'])->get()->toArray();
		return view("contactsList",['contacts'=> $contacts,'status'=>$status]);
		
	}
	public function export()
	{
		$table_contact=DB::table('contacts');
		$contacts=$table_contact->select(['id','prenom','nom','date_naissance','email','telephone','service','adresse','cp','ville'])->get()->toArray();
		
		$filePath = 'export.xlsx';
		$writer = WriterFactory::create(Type::XLSX);
		$writer->openToFile($filePath);
		foreach($contacts as $contact)
		{
			$writer->addRow((array)$contact); // add a row at a time
		}
		
		$writer->close();
		
		$src=$filePath;
		if(is_file($src)){

			$finfo=finfo_open(FILEINFO_MIME_TYPE);

			$content_type =finfo_file($finfo, $src);

			finfo_close($finfo);

			$file_name= basename($src).PHP_EOL;

			$size = filesize ($src);

			header("Content_type:$content_type");

			header("Content-Disposition:attachement;filename=$file_name");

			header("Content-Transfer-Encoding: binary");

			Header("Content_Length:$size");

			readfile($src);

		}
	}
	public function add()
    {
		$contact=Input::all();
		if(isset($contact) && !empty($contact) && isset($contact["action"]) && $contact["action"]==1 && $this->validation($contact))
		{	
			unset($contact["_token"]);
			unset($contact["action"]);
			App\Contacts::create($contact);
			return $this->list(1);
		}
		else if(isset($contact) && !empty($contact))
		{
			return view("contactsForm",['titre'=> "Ajout" , "contact" => array("0"=>(object)$contact) ,'action'=>1, 'error'=>1]);
		}
		else
		{
			return view("contactsForm",['titre'=> "Ajout" ,'action'=>1]);
		}
    }
	
	public function edit($contactId)
    {
		$record=App\Contacts::where("id",$contactId)->get();
		$contact=Input::all();
		if(isset($contact) && isset($contact["action"]) && $contact["action"]==2 && $this->validation($contact))
		{	
			unset($contact["_token"]);
			unset($contact["action"]);
			App\Contacts::where("id",$contactId)->update($contact);
			return $this->list(1);
		}
		else if(isset($contact) && !empty($contact))
		{			
			$contact['id']=$contactId;
			return view("contactsForm",['titre'=> "Modification","contact"=> array("0"=>(object)$contact),'action'=>2, "error"=>1]);
		}
		else
		{
			return view("contactsForm",['titre'=> "Modification","contact"=> $record,'action'=>2]);
		}
    }
	
	public function validation($donnees)
	{
		if(empty($donnees["prenom"]) || empty($donnees["nom"])|| empty($donnees["email"]))
		{
			return false;
		}
		if(filter_var($donnees["email"], FILTER_VALIDATE_EMAIL)==false)
		{
			return false;
		}
		return true;
	}
	public function delete($contactId)
	{
		App\Contacts::where("id",$contactId)->delete();
		return redirect('contacts');
	}
}
