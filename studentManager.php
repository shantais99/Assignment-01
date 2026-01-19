<?php

class StudentManager
{ private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    // JSON ফাইল থেকে সব student পড়া
    private function readData()
    {
        $json = file_get_contents($this->file);
        return json_decode($json, true);
    }

    // JSON ফাইলে সব student লেখা
    private function writeData($data)
    {
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    // সব student দেখানো
    public function getAllStudents()
    {
        return $this->readData();
    }

    // ID দিয়ে student খোঁজা
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

    // নতুন student যোগ করা
    public function create($data)
    {
        $students = $this->readData();

        // Duplicate ID চেক
        foreach ($students as $student) {
            if ($student['id'] == $data['id']) {
                return false;
            }
        }

        // Email validation
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $students[] = $data;
        $this->writeData($students);
        return true;
    }

    // student আপডেট করা
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

    // student ডিলিট করা
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