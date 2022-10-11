<?php
namespace App\Models;

use MF\Model\Model;
use App\Connection;

class Usuario extends Model{

    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __get($atributo)
    {
        return $this->$atributo;
    }
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    //salvar  cadastro
    public function salvar_usuario(){
        $query = "INSERT INTO usuarios (nome,email,senha) values (:nome,:email,:senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome',$this->__get('nome'));
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->bindValue(':senha',$this->__get('senha')); // Md5 -> hash 32 caracteres para criptografar a senha
        $stmt->execute();
        return $this;
    }

    //validar se um cadastro pode ser feito
    public function validarCadastro(){

        if (strlen($this->__get('nome')) < 3 || strlen($this->__get('email')) < 5 || strlen($this->__get('senha')) < 4) {
            return false;
        }else{
            return true;
        }

    }
    //recuperar um usuário por e-mail
    public function getUsuarioPorEmail(){
        $query = "select nome, email from usuarios where email = :email";
        $stmt = $this->db->query->prepare($query);
        $stmt->bindValue(:email,$this->__get('email'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCCH_ASSOC);
    }

}

?>