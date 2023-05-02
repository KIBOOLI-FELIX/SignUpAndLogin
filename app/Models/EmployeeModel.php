<?php
namespace App\Models;
use \CodeIgniter\Model;

class EmployeeModel extends Model{
  protected $table="employees";
  protected $primaryKey = "id";
  protected $returnType = "object";
  protected $allowedFields=['name','email','salary','city','designation','mobile'];
  // Dates
  protected $useTimestamps=true;
  protected $dateFormat='datetime';
  protected $createdField='created_at';
  protected $updatedField='updated_at';
  protected $deletedField='deleted_at';
  // Validation
  protected $validationRules=[
    "name"=>"required|alpha_numeric_space|min_length[3]",
    "email"=>"required|valid_email|is_unique[employees.email]",
    "salary"=>"required|min_length[4]",
    "mobile"=>"required|numeric|exact_length[10]",
    "city"=>"required",
    "designation"=>"required"
  ];
  protected $validationMessages=[
    "email"=>[
      "is_unique"=>"Email already exists",
      "valid_email"=>"Valid email address is required",
    ]
  ];

}