# miniProyecto1

## Descripción
`miniProyecto1` es una aplicación web desarrollada en **Laravel 12** que permite a los usuarios resolver problemas matemáticos y estadísticos simples de forma interactiva. Cada problema se muestra con un formulario, permite ingresar datos, valida los valores ingresados y muestra resultados automáticamente.  
El proyecto incluye un sistema de **autoría automática** donde se asigna un desarrollador según el número de problema (Cristopher Núñez para problemas impares y Juan Carrion para problemas pares), así como la fecha de resolución.  

El diseño utiliza **Bootstrap** para la interfaz y **estilos personalizados** con gradientes, tarjetas y botones con efecto visual moderno.

## Características principales
- Formularios para resolver problemas matemáticos y estadísticos.  
- Validación de entradas: solo se aceptan números positivos.  
- Cálculo automático de:
  - Media
  - Desviación estándar
  - Mínimo y máximo
- Footer y firma de autor dinámicos.
- Interfaz limpia y moderna con **Bootstrap 5** y estilos personalizados.
- Navegación mediante un menú de selección de problemas.
- Diseño responsivo para desktop y mobile.

## Tecnologías utilizadas
- **Laravel 12.33.0**  
- **PHP 8.4.0**  
- **Bootstrap 5**  
- **JavaScript** (solo para validaciones menores y mejoras UX)  
- **CSS personalizado** con gradientes, flexbox y tarjetas  
- **Composer** para gestión de dependencias

## Instalación
1. Clonar el repositorio:

```bash
git clone https://github.com/tu-usuario/miniProyecto1.git
cd miniProyecto1
