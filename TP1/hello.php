<?php
    function hello() 
    {
        for ($i = 1; $i <= 10; $i++)
        {
            echo "Hello world <br>";
        }
    }
    function bissextile($year)
    {
        $res = "false";
        if ($year % 4 == 0)
        {
            if ($year % 100 != 0 || $year % 400 == 0)
            {
                $res = "true";
            }
        }
       return $res;
    }

    function tabmulti()
    {
        for ($i = 0; $i <= 10; $i++)
        {
           for ($j = 0; $j <= 10; $j++)
            {
               echo "$i * $j = ". $i*$j. "<br>";  
            } 
            echo"<br>";
        }
    }

     function tabcolor()
     {
    echo "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>";
    echo "<tr>";
    for($i = 0; $i<=9; $i++)
    {
        if($i !=0)
        {
        echo "<th>$i<th>";
        }
        else
        {
            echo "";
        }
    }
    echo "</tr>";

    echo "<tbody>";
  
    for($i = 0; $i<=9; $i++)
    {
        for($j = 0; $j<= 9; $j++)
        {
            
            if($j != 0 && $i != 0)
            {
                echo "<tr>";
                echo "<td>".$i * $j."<td>";
                echo"</tr>";
            }
            else
            {
                echo $i;
            }
        }
    }
    echo "</tbody>";


    }
    
    tabcolor();
    
?>