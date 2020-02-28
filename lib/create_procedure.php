<?php

function create_procedure($conn, $prcd_name){
  $flag="NO"; //프로시저 존재 유무
  $sql = "show procedure status";
  $result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));

  while ($row=mysqli_fetch_row($result)) {
    if($row[1] === "$prcd_name"){//문자열로 넘어오므로 ""으로 처리 ''은 문자열뿐아니라 속성도 반영
      //eduplanet 스키마에 찾는 테이블이 있는 경우
      $flag="OK";
      break;
    }
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
        case 'get_new_academy_serialize':
          $sql='CREATE PROCEDURE `get_new_academy_serialize`()
          BEGIN

          SELECT * FROM
            (select no, concat( si_name, "$", dong_name, "$", sector, "$", acd_name, "$", rprsn, "$", class, "$", tel, "$", address) as acd_srl
            from academy) acd
          RIGHT OUTER JOIN
            (select no as t_no, concat( si_name, "$", dong_name, "$", sector, "$", acd_name, "$", rprsn, "$", class, "$", tel, "$", address) as temp_srl
            from academy_temp) acd_tmp
          ON
            acd.acd_srl = acd_tmp.temp_srl
          WHERE
            acd.acd_srl
          IS NULL;

          END';
        break;
        case 'get_empty_academy_serialize':
          $sql='CREATE PROCEDURE `get_empty_academy_serialize`()
          BEGIN

          SELECT * FROM
             (select no as t_no, concat( si_name, "$", dong_name, "$", sector, "$", acd_name, "$", rprsn, "$", class, "$", tel, "$", address) as temp_srl
            from academy_temp) acd_tmp
          RIGHT OUTER JOIN
            (select no, concat( si_name, "$", dong_name, "$", sector, "$", acd_name, "$", rprsn, "$", class, "$", tel, "$", address) as acd_srl
            from academy) acd
          ON
            acd_tmp.temp_srl = acd.acd_srl
          WHERE
            acd_tmp.temp_srl
          IS NULL;

          END';
        break;
        case "modify_data_for_testing":
          $sql="CREATE PROCEDURE `modify_data_for_testing`()
          BEGIN
          delete from academy where no=3 or no=4 or no=5 or no=6 or no =7;
          delete from academy_temp where no=23 or no=24 or no=26;
          update academy_temp set acd_name='미래능력개발교육원' where no =8;
          update academy_temp set acd_name='과거능력개발교육원' where no =9;
          update academy_temp set acd_name='초능력개발교육원' where no =29;
          END";
        break;

        case "get_gm_sales":
          $sql="CREATE PROCEDURE `get_gm_sales`(IN start_y CHAR(4), IN last_y CHAR(4), IN start_m CHAR(2), IN last_m CHAR(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(start_y,'-', start_m, '-01');
                SET last_date = CONCAT(last_y,'-', last_m, '-01');
                SET last_date = LAST_DAY(last_date);

            SELECT
            temp.date, origin.total
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
              `date`, SUM(`price`) AS `total`
            FROM
              gm_order
            WHERE
              DATE(`date`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`date`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
            GROUP BY date) AS origin
                ON temp.date = origin.date
            ORDER BY temp.date;

          END";
        break;

        case "get_am_sales":
          $sql="CREATE PROCEDURE `get_am_sales`(IN start_y CHAR(4), IN last_y CHAR(4), IN start_m CHAR(2), IN last_m CHAR(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(start_y,'-', start_m, '-01');
                SET last_date = CONCAT(last_y,'-', last_m, '-01');
                SET last_date = LAST_DAY(last_date);

            SELECT
            temp.date, origin.total
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
              `date`, SUM(`price`) AS `total`
            FROM
              am_order
            WHERE
              DATE(`date`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`date`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
            GROUP BY date) AS origin
                ON temp.date = origin.date
            ORDER BY temp.date;

          END";
        break;

        case "get_am_order_year_sales":
          $sql="CREATE PROCEDURE `get_am_order_year_sales`(IN last_y INT(4), IN last_m INT(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(IF(last_m=12, last_y, last_y-1),'-', IF(last_m=12, 1, last_m-1), '-01');
                SET last_date = CONCAT(last_y,'-', last_m, '-01');
                SET last_date = LAST_DAY(last_date);

            SELECT
            MONTH(temp.date)as month, origin.sales
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
              a.date BETWEEN start_date AND last_date
            group by MONTH(a.date)
                order by a.date) AS temp
                LEFT JOIN
              (SELECT
                YEAR(date)as year, MONTH(date)as month, SUM(price)as sales
              FROM
                am_order
              WHERE
                DATE(`date`) >= STR_TO_DATE(start_date, '%Y-%m-%d')
                  AND DATE(`date`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
              GROUP BY LEFT(date, 7)
              ORDER BY date) AS origin
                ON MONTH(temp.date) = origin.month and YEAR(temp.date) = origin.year;

          END";
        break;

        case "get_gm_order_year_sales":
          $sql="CREATE PROCEDURE `get_gm_order_year_sales`(IN last_y INT(4), IN last_m INT(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(IF(last_m=12, last_y, last_y-1),'-', IF(last_m=12, 1, last_m-1), '-01');
                SET last_date = CONCAT(last_y,'-', last_m, '-01');
                SET last_date = LAST_DAY(last_date);

            SELECT
            MONTH(temp.date)as month, origin.sales
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
              a.date BETWEEN start_date AND last_date
            group by MONTH(a.date)
                order by a.date) AS temp
                LEFT JOIN
              (SELECT
                YEAR(date)as year, MONTH(date)as month, SUM(price)as sales
              FROM
                gm_order
              WHERE
                DATE(`date`) >= STR_TO_DATE(start_date, '%Y-%m-%d')
                  AND DATE(`date`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
              GROUP BY LEFT(date, 7)
              ORDER BY date) AS origin
                ON MONTH(temp.date) = origin.month and YEAR(temp.date) = origin.year;
          END";
        break;

        case "get_day_reivew_for_one_month":
          $sql="CREATE PROCEDURE `get_day_reivew_for_one_month`(IN y CHAR(4), IN m CHAR(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(y,'-', m, '-01');
                SET last_date = LAST_DAY(start_date);

            SELECT
            temp.date, origin.count
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
              review
            WHERE
              DATE(`regist_day`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`regist_day`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
            GROUP BY date) AS origin
                ON temp.date = origin.date
            ORDER BY temp.date;
          END";
        break;

        case "get_day_story_for_one_month":
          $sql="CREATE PROCEDURE `get_day_story_for_one_month`(IN y CHAR(4), IN m CHAR(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(y,'-', m, '-01');
                SET last_date = LAST_DAY(start_date);

            SELECT
            temp.date, origin.count
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
              acd_story
            WHERE
              DATE(`regist_day`) >= STR_TO_DATE(start_date, '%Y-%m-%d') AND DATE(`regist_day`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
            GROUP BY date) AS origin
                ON temp.date = origin.date
            ORDER BY temp.date;

          END";
        break;

        case "get_story_sixmonth_data":
          $sql="CREATE PROCEDURE `get_story_sixmonth_data`(IN last_y INT(4), IN last_m INT(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(IF(last_m<=5, last_y-1, last_y),'-', IF(last_m<=5, last_m+7, last_m-5), '-01');
                SET last_date = CONCAT(last_y,'-', last_m, '-01');
                SET last_date = LAST_DAY(last_date);

            SELECT
            MONTH(temp.date)as month, origin.count
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
              a.date BETWEEN start_date AND last_date
            group by MONTH(a.date)
                order by a.date) AS temp
                LEFT JOIN
              (SELECT
                YEAR(regist_day)as year, MONTH(regist_day)as month, COUNT(*)as count
              FROM
                acd_story
              WHERE
                DATE(`regist_day`) >= STR_TO_DATE(start_date, '%Y-%m-%d')
                  AND DATE(`regist_day`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
              GROUP BY LEFT(regist_day, 7)
              ORDER BY regist_day) AS origin
                ON MONTH(temp.date) = origin.month and YEAR(temp.date) = origin.year;

          END";
        break;

        case "get_review_sixmonth_data":
          $sql="CREATE PROCEDURE `get_review_sixmonth_data`(IN last_y INT(4), IN last_m INT(2))
          BEGIN
                DECLARE start_date CHAR(10);
                DECLARE last_date CHAR(10);
                SET start_date = CONCAT(IF(last_m<=5, last_y-1, last_y),'-', IF(last_m<=5, last_m+7, last_m-5), '-01');
                SET last_date = CONCAT(last_y,'-', last_m, '-01');
                SET last_date = LAST_DAY(last_date);

            SELECT
            MONTH(temp.date)as month, origin.count
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
              a.date BETWEEN start_date AND last_date
            group by MONTH(a.date)
                order by a.date) AS temp
                LEFT JOIN
              (SELECT
                YEAR(regist_day)as year, MONTH(regist_day)as month, COUNT(*)as count
              FROM
                review
              WHERE
                DATE(`regist_day`) >= STR_TO_DATE(start_date, '%Y-%m-%d')
                  AND DATE(`regist_day`) <= STR_TO_DATE(last_date, '%Y-%m-%d')
              GROUP BY LEFT(regist_day, 7)
              ORDER BY regist_day) AS origin
                ON MONTH(temp.date) = origin.month and YEAR(temp.date) = origin.year;

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
