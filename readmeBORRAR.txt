//////////////////////////////////////////////////////
/////////////////USO DE GUION BAJO///////////////////
////////////////////////////////////////////////////

En PedidosRepository tenemos que acceder al EntityManager usando el guión bajo.

$proveedor = $this->_em->getRepository(ProveedoresEntity::class)->find($data['idProveedor']);

El uso del guión bajo (_) antes de la variable em en $this->_em es una convención de nomenclatura que se utiliza en algunos lenguajes de programación y estilos de codificación para denotar que una propiedad o un método es privado o protegido, y por lo tanto, no se debe acceder directamente desde fuera de la clase.

En el contexto de los repositorios de Doctrine, _em es una propiedad protegida que representa el EntityManager de Doctrine. Esta propiedad es automáticamente inyectada en todas las clases que extienden EntityRepository, lo que les permite interactuar con la base de datos.

El guión bajo es una forma de indicar a los desarrolladores que em es una propiedad interna del repositorio y no debería ser modificada directamente. En cambio, se debe utilizar los métodos proporcionados por la clase EntityRepository para realizar operaciones en la base de datos.

Es importante señalar que el uso del guión bajo es más común en lenguajes como PHP, y su uso puede variar según el estilo de codificación del proyecto. En algunos proyectos o estilos de codificación modernos, puede que no se utilice el guión bajo, pero sigue siendo una práctica común en muchos códigos, especialmente aquellos que han mantenido convenciones más antiguas.