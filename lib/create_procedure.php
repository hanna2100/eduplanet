<?php

function create_procedure($conn, $prcd_name, $arr_size){
  $flag="NO"; //프로시저 존재 유무
  $sql = "show procedure status";
  $result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

  if (mysqli_num_rows($result)==$arr_size) {
    $flag="OK";
  }//end of if

  if($flag==="NO"){
    switch($prcd_name){
          case 'get_join_g_members' : //일반회원(general members)
            $sql = "CREATE PROCEDURE `get_join_g_members`(IN start_y CHAR(4), IN last_y CHAR(4), IN start_m CHAR(2), IN last_m CHAR(2))
            BEGIN 
                  DECLARE start_date CHAR(10);
                  DECLARE last_date CHAR(10);
                  SET start_date = CONCAT(start_y,'-', start_m, '-01');
                  SET last_date = CONCAT(last_y,'-', last_m, '-01');
                  SET last_date = LAST_DAY(last_date);
                  
              SELECT 
              temp.date, data.count
              FROM
              (SELECT 
                a.date
              FROM
                (SELECT 
                CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a) + (1000 * d.a)) DAY AS date
              FROM
                (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS d) a
              WHERE
                a.date BETWEEN start_date AND last_date) AS temp
                LEFT JOIN
              (SELECT 
                `regist_day` AS `date`, COUNT(*) AS `count`
              FROM
                g_members
              WHERE
                DATE(`regist_day`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`regist_day`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
              GROUP BY date) AS data 
                  ON temp.date = data.date
              ORDER BY temp.date;
                  
            END";
            break;

          case 'get_join_a_members' :
            $sql = "CREATE PROCEDURE `get_join_a_members`(IN start_y CHAR(4), IN last_y CHAR(4), IN start_m CHAR(2), IN last_m CHAR(2))
            BEGIN 
                  DECLARE start_date CHAR(10);
                  DECLARE last_date CHAR(10);
                  SET start_date = CONCAT(start_y,'-', start_m, '-01');
                  SET last_date = CONCAT(last_y,'-', last_m, '-01');
                  SET last_date = LAST_DAY(last_date);
                  
              SELECT 
              temp.date, data.count
              FROM
              (SELECT 
                a.date
              FROM
                (SELECT 
                CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a) + (1000 * d.a)) DAY AS date
              FROM
                (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS d) a
              WHERE
                a.date BETWEEN start_date AND last_date) AS temp
                LEFT JOIN
              (SELECT 
                `regist_day` AS `date`, COUNT(*) AS `count`
              FROM
                a_members
              WHERE
                DATE(`regist_day`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`regist_day`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
              GROUP BY date) AS data 
                  ON temp.date = data.date
              ORDER BY temp.date;
                  
            END";
          break;

          case 'get_wthdr_g_members' :
            $sql = "CREATE PROCEDURE `get_wthdr_g_members`(IN start_y CHAR(4), IN last_y CHAR(4), IN start_m CHAR(2), IN last_m CHAR(2))
            BEGIN 
                  DECLARE start_date CHAR(10);
                  DECLARE last_date CHAR(10);
                  SET start_date = CONCAT(start_y,'-', start_m, '-01');
                  SET last_date = CONCAT(last_y,'-', last_m, '-01');
                  SET last_date = LAST_DAY(last_date);
                  
              SELECT 
              temp.date, data.count
              FROM
              (SELECT 
                a.date
              FROM
                (SELECT 
                CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a) + (1000 * d.a)) DAY AS date
              FROM
                (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS d) a
              WHERE
                a.date BETWEEN start_date AND last_date) AS temp
                LEFT JOIN
              (SELECT 
                `wthd_date` AS `date`, COUNT(*) AS `count`
              FROM
                withdrawal
              WHERE
                DATE(`wthd_date`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`wthd_date`) <= STR_TO_DATE(last_date, '%Y-%m-%d') AND type='G' 
              GROUP BY date) AS data 
                  ON temp.date = data.date
              ORDER BY temp.date;
                  
            END";
          break;

          case 'get_wthdr_a_members' :
            $sql = "CREATE PROCEDURE `get_wthdr_a_members`(IN start_y CHAR(4), IN last_y CHAR(4), IN start_m CHAR(2), IN last_m CHAR(2))
            BEGIN 
                  DECLARE start_date CHAR(10);
                  DECLARE last_date CHAR(10);
                  SET start_date = CONCAT(start_y,'-', start_m, '-01');
                  SET last_date = CONCAT(last_y,'-', last_m, '-01');
                  SET last_date = LAST_DAY(last_date);
                  
              SELECT 
              temp.date, data.count
              FROM
              (SELECT 
                a.date
              FROM
                (SELECT 
                CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a) + (1000 * d.a)) DAY AS date
              FROM
                (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
              CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS d) a
              WHERE
                a.date BETWEEN start_date AND last_date) AS temp
                LEFT JOIN
              (SELECT 
                `wthd_date` AS `date`, COUNT(*) AS `count`
              FROM
                withdrawal
              WHERE
                DATE(`wthd_date`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`wthd_date`) <= STR_TO_DATE(last_date, '%Y-%m-%d') AND type='A' 
              GROUP BY date) AS data 
                  ON temp.date = data.date
              ORDER BY temp.date;
                  
            END";
          break;
          
      default:
        echo "<script>alert('해당 프로시저가 없습니다. ');</script>";
        break;
    }//end of switch

    if(mysqli_query($conn,$sql)){
      echo "<script>alert('$prcd_name 프로시저가 생성되었습니다.');</script>";
    }else{
      echo "프로시저 생성 실패 : ".mysqli_error($conn);
    }
  }//end of if flag
}//end of function
?>