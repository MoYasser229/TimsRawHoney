<?php
class surveyModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/surveyStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    private $surveys;
    public function surveys(){
        $result = $this->database->query("SELECT * FROM survey");
        return mysqli_num_rows($result);
    }
    public function avgSurvey(){
        $result = $this->database->query("SELECT ((AVG((questionOne+questionTwo + questionThree + questionFour + questionFive)/5))/5)*100 as satisfaction FROM `survey`");
        return $result->fetch_assoc();
    }
    public function databaseSurvey(){
        $result = $this->database->query("SELECT *,(((questionOne+questionTwo + questionThree + questionFour + questionFive)/5)/5)*100 as satisfaction FROM survey,users WHERE survey.customerID = users.ID");
        $this->surveys = $result;
    }
    public function filterSurveys($type,$filter){
        $result = $this->database->query("SELECT *,(((questionOne+questionTwo + questionThree + questionFour + questionFive)/5)/5)*100 as satisfaction FROM survey,users WHERE survey.customerID = users.ID ORDER BY $type $filter");
        $this->surveys = $result;
    }
    public function display(){
        if(mysqli_num_rows($this->surveys) == 0){
            echo "<div class='emptyList'>
            <i class='fa-solid fa-triangle-exclamation'></i>
            <p>Nothing Found. Please check that the product searched is an actual product or add a new product. </p>
        </div>";
        }
        else{
            echo "<div class='surveyGrid'>";
        foreach($this->surveys as $survey){
            $description = "<h3>Survey Description:</h3>
            <h4>{$survey['description']}</h4>";
            if(empty($survey['description'])){
                $description = "";
            }
            echo "
                <div class='surveyCard'>
                    <h1>{$survey['fullName']}</h1>
                    <hr>
                    <h3>Customer Satisfaction: ".ceil($survey['satisfaction'])."%</h3>
                    <h3>Customer ID: {$survey['customerID']}</h3>
                    <h3>Customer Phone Number: {$survey['phoneNumber1']}</h3>
                    $description
                </div>
            ";
        }
        echo "</div>";
    }
    
    }
    public function searchSurvey($search){
        $result = $this->database->query("SELECT *,(((questionOne+questionTwo + questionThree + questionFour + questionFive)/5)/5)*100 as satisfaction FROM survey,users WHERE ((fullName LIKE '%$search%') OR (customerID LIKE '%$search%'))");
        $this->surveys = $result;
    }
}