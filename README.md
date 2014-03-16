ProyeccionEscolar
=================

Sistema de calificaciones en línea

Los profesores requieren llevar un registro de sus alumnos para el control de asistencias y la evaluación continua. El propósito de este proyecto será que en línea el profesor pueda capturar calificaciones de sus alumnos y llevar el registro de asistencias. El flujo del sistema sería como a continuación se describe:

    El administrador del sitio captura los ciclos escolares
    El profesor captura un curso para un ciclo o clonar un curso anterior para un nuevo ciclo
    El profesor genera la reglas de evaluación del curso
    El profesor da de alta alumnos a un curso
    El profesor captura calificaciones de alumnos y/o asistencias
    Los alumnos pueden revisar sus calificaciones en línea y sus asistencias
========================================================================================================================
La lista de alumnos

El listado de alumnos será cargado al sistema por medio de archivos separados por comas, aunque también pueden ser cargados manualmente.
De los alumnos se almacenará, el código, nombre completo, carrera y correo electrónico.
El profesor puede además indicar por medio de checkbox campos extras para capturar del alumno, tales como celular, cuenta de github, página web.
Cada alumno tiene un status para indicar si esta activo o no, de este modo, se pueden seleccionar alumnos que sean enviados como no activos lo que provocará que no aparezcan en las listas de asistencias ni calificaciones.

========================================================================================================================
Los ciclos escolares

El administrador del sistema realiza la captura del ciclo escolar indicando el ciclo en el formato "2013A" así como la fecha de inicio y la fecha de finalización.
Al crear un ciclo escolar el administrador debe indicar los días no efectivos dentro de ese ciclo escolar, es decir, deberá seleccionar de un calendario los días que no habrán clases y deberá indicar el motivo para cada día.

========================================================================================================================
Los cursos
El profesor podrá capturar sus cursos y seleccionar el ciclo escolar al que aplicarán, de un curso se captura el nombre, la sección, el NRC, la academia a la que pertenece, los días de clase, la cantidad de horas por cada día y los horarios de cada día.

========================================================================================================================
Clonar cursos
La clonación de un curso es la creación de un nuevo curso para un nuevo ciclo escolar con las mismas caracteristicas que un curso previo, pero sin los datos de alumnos, asistencias ni calificaciones.
Forma de Evaluación
Un profesor dará de alta la evaluación de un curso indicando la actividad y el porcentaje que representará para la calificación final.

========================================================================================================================
Hojas extras de evaluación
Un profesor puede requerir hojas extras de evaluación continua, donde captura por ejemplo la calificación individual de cada práctica, donde el promedio podría ser la calificación de uno de los rubros que se tienen en la configuración de la evaluación.
Un profesor puede tener como máximo la cantidad de hojas extras de evaluación igual a la cantidad de rubros en la configuración de la evaluación.
Al estar capturando la configuración de la evaluación el profesor deberá indicar si ese rubro requiere una hoja de evaluación y cuantas columnas requiere.
Todas las hojas de evaluación obtendrán la calificación final por medio de "promedio" y esta calificación se asignará al rubo que le corresponde en la hoja de evaluación continua.

========================================================================================================================
Calificaciones
Las calificaciones se deben capturar de la manera que usted considere mas adecuada, pensando siempre en la facilidad para el profesor, y se debe validar calificaciones numéricas sobre 10 aceptando 1 decimal. Se permite también la nomenclatura NP y SD las cuales son interpretadas como 0 para los cálculos.

========================================================================================================================
Asistencias
La tabla de asistencias de un curso debe aparecer con asistencias por default, y se debe poder cambiar a falta uno por uno de los alumnos, o seleccionar varios alumnos por medio de un chechkbox y elegir la opción de poner falta.
La lista de asistencias debe contabilizar los días de clase y en base a esto obtener porcentajes de asitencia individuales así como porcentaje de asistencia grupal.

========================================================================================================================
Los alumnos
Los alumnos pueden ingresar al sistema por medio de su código y una contraseña, y tendrán acceso a sus calificaciones y su registro de asistencias.
No podrán ver calificaciones de otros compañeros, pero si, calificaciones de todos los cursos en los que esten registrados.
