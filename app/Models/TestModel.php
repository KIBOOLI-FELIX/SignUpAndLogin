<?php
namespace App\Models;
use CodeIgniter\Model;

class TestModel extends Model{
  protected $table="volunteer";
  protected $primaryKey = "id";
  protected $returnType = "array";
}
?>