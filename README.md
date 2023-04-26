# TFG-Guillermo_Lorca
## Portada:
    Guillermo Lorca Martínez, Desarrollo de Aplicaciones Web, 2022/2023.
    FILMSS
    Alejandro Furriol, Quique Galduf
    CIP FP Cheste 
## Memòria:
1. Agraïments (opcional)
2. Resum/Abstract: Una descripció breu en anglés i un altra llengua a elegir entre
castellà o valencià. (200-400 paraules)
3. Planificació de les tasques i temporalització
4. Diseny:
   * a. **Diseny de la Base de dades. Cal incloure el diagrama físic (SQL o noSQL) amb la descripció de taules i camps. Si es possible també el diseny conceptual del model entitat-relació.** En este apartado vamos ha realizar el diseño de la Base de Datos. Nuestra BD tiene una peculiaridad ya que  hemos decidido utilizar una Api para extraer datos. Concretamente la Api nos dara datos sobre peliculas, series y de mas contenido, datos que nosotros utilizaremos para nuestro buscador. La peculiaridad es que en nuestra BD no se almacenaran los datos de los contenidos multimedia, si no que guardaremos comentarios, valoraciones y watch_list en los que se hara referencia ha los nombres de por ejemplo una pelicula.
   
      En nuestra BD hay diferentes entidades con sus diferentes atributos.Cada entidad representa una tabla de nuestra BD y sus atributos representan las columnas de dichas tablas. Ademas estas entidades estan relacionadas, por lo tanto las tablas tambien lo estan.Vamos ha listar las entidades, sus atributos y por lo tanto sus relaciones:
      - **Usuario:** Un usuario de nuestra web podra optar ha distintas funcionalidades como tener su propia WatchList y la posibilidad de jugar a distintos juegos. De cada usuario guardaremos el *Nombre*, *Apellido* y el *Email*.
         
         Esta tabla representa a los usuarios y sus atributos. Podemos ver que cada usuario tendra un id identificatvo que sera unico para cada usuario . Ademas este id se creara automaticamente y se ira auto incrementando.<image src="BD/users.PNG" alt="USERS">

      - **WatchList:** Esta entidad es una lista personalizada que tendra cada usuario. En esta lista los usuarios podran guardarse peliculas series y demas contenido. Podran guardarse contenido que hayan visto y les haya gustado mucho, contenido que quieren ver en un futuro y hayan descubierto en nuestra web o tambien personas de sus peliculas favoritas.

         En esta tabla hay una Clave primaria compuesta de dos columnas, el id del usuario "user_id" y el nombre del contenido. Lo que conseguimos asi es que un mismo usuario no pueda tener repetido un contenido en su watch_list. Ademas esta tabla tendra tambien un campo llamado estado, en el que pondremos lo que quiere hacer ese usuario con ese contenido.<image src="BD/watch_list.PNG" alt="USERS">

         La tabla tiene una Clave ajena en la que se relaciona el user_id de esta tabla, con el id de la tabla usuarios. Es una relacion uno a muchos ya que un usuario puede tener muchos contenidos dentro de su watch_list y una watch_list solo puede ser de un usuario.<image src="BD/watch_list2.PNG" alt="USERS">
         
      - **Comentarios:** En nuestra web se podran guardar comentarios sobre toda clase de contenido multimedia, es decir si te ha gustado una pelicula podras dejar un comentario o si una persona te parece una gran actriz pues tambien lo puedes publicar.

         La tabla guardaria el nombre del contenido sobre el que se comenta, el usuario que ha publicado el comentario y obiamente el comentario.La clave primaria de esta tabla seria un id generado automaticamente que identificaria cada comentario.                               
         <image src="BD/comentarios.PNG" alt="USERS">

         Como hemos observado anteriormente esta tabla tambien se relaciona con la tabla users atraves de una Clave ajena.<image src="BD/comentarios2.PNG" alt="USERS">
      
      - **Valoraciones:** Para nuestra web hemos pensado guardar las valoraciones de los contenidos multimedia que consigamos de la API. Con esta entidad conseguimos que los usuarios nos digan que es lo que mas les gusta y ademas conseguimos crear una comunidad, ya quesolo los usuarios de nuestra web podran valorarlas.

         Para esta tabla hemos decidido guardar el contenido que se va ha valorar, comno es logico la valoracion y atraves de una Clave ajena el usuario que ha realizado tal valoracion. La Clave primaria estara compuesta del id del usario y del contenido, asi conseguimos que un uasuario solo pueda valorar el contenido una vez.                <image src="BD/valoraciones.PNG" alt="USERS">
      
      - **Puntuaciones:** Un apartado que ofreceremos en nuestra web es el de los juegos, en el que añadiremos distintos juegos sobre peliculas, series...  Por lo tanto esta entidad consiste en las puntuaciones 

         Para esta tabla hemos decidido guardar el contenido que se va ha valorar, comno es logico la valoracion y atraves de una Clave ajena el usuario que ha realizado tal valoracion. La Clave primaria estara compuesta del id del usario y del contenido, asi conseguimos que un uasuario solo pueda valorar el contenido una vez.                <image src="BD/rankings.PNG" alt="USERS">

   * b. Diseny dels objectes.
        * i. Diagrames de clases, amb les clases i els atributs.
        * ii. Diagrames de sequencies, activitats, casos d’ús o en definitiva
qualsevol diagrama que explique les funcionalitats de la aplicació.
   * c. Mapa web (opcional). Gràfic que mostra els enllaços entre pàgines
   * d. Drafts/borradors/mockup del projecte i les interficies.
5. Codificació
a. Tecnologíes elegides i justificació (Llenguatges, frameworks, llibreríes, etc.)
b. Entorn servidor. Descripció i proves.
c. Entorn client. Descripció i proves.
6. Documentació
a. Manual de usuari (Es pot incloure directament a la web)
b. Documentació del codi (Es pot incloure directament al codi amb comentaris)
7. Desplegament
a. Diagrama o explicació del desplegament: Que es veja de forma clara la
plataforma sobre la que funcionarà cadascuna de les peces software.
b. Descripció de la instalació o desplegament: Ací podem incloure els fitxers de
desplegament o les configuracions. Per exemple els dockerfile, els yml,
configuracions del núvol, configuracions d’Apache…
c. Descripció del hosting (si escau)
3
8. Eines de suport utilitzades: Ací documentarem l’ús que hem fet de ferramentes com
Github o similars.
9. Bibliografía: Llibres, articles, apunts, webs…