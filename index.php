<!DOCTYPE html>
<html>
    <head>
        <Title>Lab 7</Title>
        <meta name="description" content="Learning DB">
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <div class="pane top"></div>
        <?php
            $serverName = "COMPUTER\SQLEXPRESS";
            $connectionOptions = array("Database"=>"Film_Library");
            $conn = sqlsrv_connect($serverName, $connectionOptions);
            if($conn == false){
                echo "No connection to MsSQL Server";
            }
        ?>
        <div class="main">
            <div>
                <h2>Enter data to insert into table "Studio"</h2>
                <form method="POST">
                    <p>Name: <input type="text" name="nameS" /></p>
                    <p>Location: <input type="text" name="locationS" /></p>
                    <p>Year: <input type="number" name="yearS" /></p>
                    <input type="submit" value="Insert" class="btn">
                </form>
            </div>
            <div>
                <h2>Enter data to insert into table "Film"</h2>
                <form method="POST">
                    <p>Title: <input type="text" name="Title" /></p>
                    <p>Genre: <input type="text" name="Genre" /></p>
                    <p>Studio ID: <input type="number" name="StudioID" /></p>
                    <p>Year: <input type="number" name="Year" /></p>
                    <input type="submit" value="Insert" class="btn">
                </form>
            </div> 
        </div>

        <div style="text-align: center;"><div style="display: inline-block">
    
        <?php
        try
        {
            $nameS = "";
            $locationS = "";
            $yearS = "";
            $Title = "";
            $Genre = "";
            $StudioID = "";
            $Year = "";

            if(isset($_POST["nameS"])){
            
                $nameS = $_POST["nameS"];
            }
            if(isset($_POST["locationS"])){
            
                $locationS = $_POST["locationS"];
            }
            if(isset($_POST["yearS"])){
                
                $yearS = $_POST["yearS"];
            }
            if(isset($_POST["Title"])){
            
                $Title = $_POST["Title"];
            }
            if(isset($_POST["Genre"])){
                
                $Genre = $_POST["Genre"];
            }
            if(isset($_POST["StudioID"])){
            
                $StudioID = $_POST["StudioID"];
            }
            if(isset($_POST["Year"])){
            
                $Year = $_POST["Year"];
            }


            if(isset($_POST["nameS"])){
                $tsql = "INSERT INTO Studio(name, Location, Year) OUTPUT"
                    . " INSERTED.ID VALUES ('$nameS', '$locationS', $yearS)";

                $insertReview = sqlsrv_query($conn, $tsql);
                if($insertReview == FALSE)
                    die(FormatErrors( sqlsrv_errors()));

                sqlsrv_free_stmt($insertReview);
            }

            if(isset($_POST["Title"])){
                $tsql = "INSERT INTO Film(Title, Genre, StudioID, Year) OUTPUT"
                    . " INSERTED.ID VALUES ('$Title', '$Genre', $StudioID, $Year)";

                $insertReview = sqlsrv_query($conn, $tsql);
                if($insertReview == FALSE)
                    die(FormatErrors( sqlsrv_errors()));

                sqlsrv_free_stmt($insertReview);
            }
        }
        catch(Throwable $e)
        {
            echo("Error!");
        }
        ?>
                
        </div></div>

        <div class="main">
            <div>
                <h2>Table "Studio"</h2>
                <?php
                try
                {
                    $sql = "SELECT * FROM Studio";
                    $result = sqlsrv_query($conn, $sql); 
                    
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                    {
                        
                        echo 'Name: '.$row['name'] . "<br>";
                        echo 'Location: '.$row['Location'] . "<br>";
                        echo 'Year: '.$row['Year'] . "<br><br>";
                    }
                }
                catch(Throwable $e)
                {
                    echo("Error!");
                }
                ?>
            </div>
            <div>
                <h2>Table "Film"</h2>
                <?php
                try
                {
                    $sql = "SELECT * FROM Film";
                    $result = sqlsrv_query($conn, $sql); 
                    
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                    {
                        
                        echo 'Title: '.$row['Title'] . "<br>";
                        echo 'Genre: '.$row['Genre'] . "<br>";
                        echo 'Studio ID: '.$row['StudioID'] . "<br>";
                        echo 'Year: '.$row['Year'] . "<br><br>";
                    }
                }
                catch(Throwable $e)
                {
                    echo("Error!");
                }
                ?>
            </div> 
        </div>

        <div class="pane bot"></div>
    </body>
</html>