<?php

class StudentManager
{ private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    
    private function readData()
    {
        $json = file_get_contents($this->file);
        return json_decode($json, true);
    }

    
    private function writeData($data)
    {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

 
    public function getAllStudents()
    {
        return $this->readData();
    }

    
    public function getStudentById($id)
    {
        $students = $this->readData();

        foreach ($students as $student) {
            if ($student['id'] == $id) {
                return $student;
            }
        }

        return null;
    }

   
    public function create($data)
    {
        $students = $this->readData();

       
        foreach ($students as $student) {
            if ($student['id'] == $data['id']) {
                return false;
            }
        }

     
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $students[] = $data;
        $this->writeData($students);
        return true;
    }

    
    public function update($id, $data)
    {
        $students = $this->readData();

        foreach ($students as $index => $student) {
            if ($student['id'] == $id) {
                $students[$index] = array_merge($student, $data);
                $this->writeData($students);
                return true;
            }
        }

        return false;
    }

  
    public function delete($id)
    {
        $students = $this->readData();

        foreach ($students as $index => $student) {
            if ($student['id'] == $id) {
                array_splice($students, $index, 1);
                $this->writeData($students);
                return true;
            }
        }

        return false;
    }
    

}
