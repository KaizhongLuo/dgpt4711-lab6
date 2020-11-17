<?php

namespace App\Controllers;

class Travel extends BaseController {

    public function index() {
        // connect to the model

        $places = new \App\Models\Places();

        // retrieve all the records

        $records = $places->findAll();


        $table = new \CodeIgniter\View\Table();
        $headings = $places->fields;
        $displayHeadings = array_slice($headings, 2, 6);
        $table->setHeading(array_map('ucfirst', $displayHeadings));
        foreach ($records as $record) {
//            $nameLink = anchor("travel/showme/$record->id", $record->name);
//
//            $table->addRow($nameLink, $record->description,$record->link);
            
                $nameLink = anchor("travel/showme/$record->id",$record->name);

                $theimage =  '<img src="/image/'.$record->image.'"height="60px" width="60px" ">'; 

                $nameLinkss = anchor("travel/showme/$record->id","http://dgpt4711.local/travel/showme/$record->id");
                
                $table->addRow($nameLink,$theimage,$nameLinkss);
        }

        $template = [
            'table_open' => '<table cellpadding="5px">',
            'cell_start' => '<td style="border: 1px solid #dddddd;">',
            'row_alt_start' => '<tr style="background-color:#dddddd">',
        ];

        $table->setTemplate($template);

        $parser = \Config\Services::parser(); // tell it about the substitions
       

        $fields = [
            'title' => 'GuangDongHY',
            'heading' => 'GuangDongHY',
            'footer' => 'LKZ'];
        return $parser->setData($fields)
                        ->render('templates\top') .
                $table->generate() .
                        $parser->setData($fields)
                        ->render('templates\bottom');

        // get a template parser

        

        
    }

    public function showme($id) {
        // connect to the model

        $places = new \App\Models\Places();

// retrieve all the records

        $record = $places->find($id);
        
        $table = new \CodeIgniter\View\Table();
        $headings = $places->fields;
        $displayHeadings = array_slice($headings, 0, 7);
        $table->setHeading(array_map('ucfirst', $displayHeadings));
        $theimage = '<img src="/image/'.$record['image'].'">';
        $table->addRow($record['id'],$record['name'],$record['age'],$record['country'],$record['description'],$theimage);
//        $table->addRow($record->description);
//        return $table->generate();

        $template = [
            'table_open' => '<table cellpadding="5px">',
            'cell_start' => '<td style="border: 1px solid #dddddd;">',
            'row_alt_start' => '<tr style="background-color:#dddddd" >',
        ];
$table->setTemplate($template);
// get a template parser

        $parser = \Config\Services::parser(); // tell it about the substitions 
      
                $fields = [
            'title' => 'GuangDongHY',
            'heading' => 'GuangDongHY',
            'footer' => 'LKZ'];
        return $parser->setData($fields)
                        ->render('templates\top') .
                $table->generate() .
                        $parser->setData($fields)
                        ->render('templates\bottom');


// return $parser->setData($record)

// and have it render the template with those
                       // ->render('oneplace');
    }

}
