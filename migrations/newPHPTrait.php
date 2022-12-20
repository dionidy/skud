./yii migrate/create create_graph_table --fields="name:char(45),start:time,end:time,break_start:time,break_end:time"

./yii migrate/create create_dep_table --fields="name:char(45)"

./yii migrate/create create_employee_table --fields="fio:char(45),num:integer,dep_id:integer:foreignKey(dep),graph_id:integer,foreignKey(graph),email:char(45),pass:char(50),salt:char(9)"

./yii migrate/create create_user_table --fields="employee_id:integer:foreignKey(employee),role:boolean"

./yii migrate/create create_move_table --fields="employee_id:integer:foreignKey(employee),in:dateTime,out:dateTime"

./yii migrate/create create_day_type_table --fields="name:char"

./yii migrate/create create_user_calendar_table --fields="employee_id:integer:foreignKey(employee),type_id:integer:foreignKey(day_type),date_start:date,date_end:date"

./yii migrate/create create_calendar_table --fields="date:date,type_id:integer:foreignKey(day_type)"


./yii migrate/create create_day_type_table --fields="type:char(45)"
./yii migrate/create create_user_table --fields="name:string(100)"
./yii migrate/create alter_user_hash_column_to_table_user --fields="name:string(100)"

./yii migrate/create rename_user_calendar_table
./yii migrate/create alter_date_start_column_to_absence_table
./yii migrate/create alter_date_end_column_to_absence_table