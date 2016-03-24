<?php
        $link=mysql_connect('127.0.0.1','root','qazwsx');
        mysql_select_db('myOA',$link);
        $eno=$_POST['jobNum'];
        $passwd=$_POST['passWord'];
        $isEmpty=is_empty($eno,$passwd);
        $empPostion=get_postion($eno);

        if($isEmpty==1){	/*错误一：$isEmpty=1是一个赋值语句，判断使用"$isEmpty==1"*/
                header("Location: http://10.1.5.72/index/fail.html");
        }else{
                $authSql="select * from myOA.passwd where empno='$eno' and passwd='$passwd'";
                $query=mysql_query($authSql);
                $authNum=mysql_num_rows($query);
                if($authNum>0){
                        switch($empPostion){
                                case 10:
                                        header("Location: http://10.1.5.72/index/fail.html");
                                        break;
                                case 0:
                                        header("Location: http://10.1.5.72/hrPage/indexForHr.html ");
                                        break;
                                case 4:
                                        header("Location: http://10.1.5.72/userPage/indexForUser.html");
                                        break;
                                default:
                                        header("Location: http://10.1.5.72/leaderPage/indexForLeader.html");
                        }
                }else{
                        header("Location: http://10.1.5.72/index/fail.html");
                }
        }

        function is_empty($loginname,$pwd){                             //判定用户名或密码是否空
                if(empty($loginname) or empty($pwd)){
                        return 1;
                }else{
                        return 0;
                }
        }
//获取职位：0-hr	1-groupleader	2-teamleader	3-deptleader	4-PTemployees 10-异常
        function get_postion($empNum){   //错误二： function前面不能有int等修饰符 //据check_privileges获取职位类型
                $postionSql="select check_level from myOA.check_privileges where empno='$empNum'";
                $queryPost=mysql_query($postionSql);
                $postNum=mysql_num_rows($queryPost);
                if(!queryPost){                                         //判断sql执行是否正常
                        return 10;
                }else{
                        if($postNum==0){ //错误三：不能使用函数返回值作为函数参数‘if(mysql_num_rows($result)=0)’//是否为普通员工，是返回4
                                $empSql="select * from myOA.employee where empno='$empNum'";	//是isset()的参数必须是变量，不能是函数返回值
                                $empQuery=mysql_query($empSql);
                                $emplyNum=mysql_num_rows($empQuery);
                                if($emplyNum>0){
                                        return 4; //错误四：return=10和return=4 正确是：return 10 和return 4
                                }else{
                                        return 10;
                                }
                        }else{                                          //返回职位类型
                                $postArray=mysql_fetch_array($queryPost);
                                $result=$postArray['check_level'];
                                return $result;
                        }
                }
        }

        echo "异常啦！";
        mysql_close($link);
        exit();/*错误五：只是php代码，结尾不需要'?>'*/