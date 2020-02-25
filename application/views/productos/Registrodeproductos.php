<!DOCTYPE html>
<html>
<head>
	<title>Registrodeproeductos</title>
</head>
<body>
<div id="app">
 <div class="content-wrapper">
   <section class="content-header">
        <h1 class="titulopag">
            <b>
 				{{ message }}
            </b>
        </h1>
    </section>
       <section class="container-fluid">
        <p>&nbsp;</p>

        <div class="col-sm-12">
        <div v-show="but"> 
          <label> Nombre del producto </label>
          <input type="text"  v-model="productos.nombre" class ="form-control">
          <label>cantidad de producto</label>
          <input type="text"  v-model="productos.cantidad" class ="form-control">
          <label>precio del producto</label>
          <input type="text" v-model="productos.precio" class ="form-control">
          <button style="margin: 5px" class="btn btn-success" v-on:click="crearproducto()">Registrar</button>
          <a class="btn btn-success" href="<?=base_url('/Productos/ventasdeproductos')?>" >Vender producto</a>
          <button v-show="but" class="btn btn-success" v-on:click="mostrarcampos()">Actulizar producto</button>
         <button class="btn btn-success" v-show="but" v-on:click="agregarproducto()">Agragar mas producto</button>

        </div>
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                    <th>Clave del producto</th>
                    <th>Nombre del producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    
              </tr>
            </thead>
            <tbody>
              <tr v-for="pro in producto">

                <td> 
                  {{pro.producto_id}}
                </td>
                <td> 
                    {{pro.nombredelproducto}}
           
                </td>
                <td>
                 {{pro.productocontidad}}
                 
               </td>
                <td>
                  {{pro.precio_producto}}
                  
                </td>
                
              </tr>
            </tbody>
          </table>

         
          <div v-show="ban">

              <label><h3>Seleciona el producto</h3></label>
              <select v-model="productos.seleccion" class="form-control" >
                 <option v-for="pro in producto" v-bind:value="pro.producto_id"> {{pro.nombredelproducto}} </option>
               </select>           
             
              <div>
              <label>Nombre del producto</label>
               <input type="text" v-model="productos.nombre" class ="form-control" >
               <label>Cantidad del producto</label>
               <input type="text"  v-model="productos.cantidad" class ="form-control" >
               <label>Precio del producto</label>
                <input id="nombre" v-model="productos.precio" class ="form-control" >
                <button class="btn btn-success" v-on:click="actulizar()">Actulizar</button>
              </div>
              
          </div>
        </div>
        <div v-show="ban1">
                <label><h3>Seleciona el producto</h3></label>
              <select v-model="productos.seleccion" class="form-control" >
                 <option v-for="pro in producto" v-bind:value="pro.producto_id"> {{pro.nombredelproducto}} </option>
               </select>
                <h2>Agregar mas producto</h2>
                <label>Ingresa la cantidad</label>
                <input type="text"  v-model="productos.cantidad" class ="form-control" >
                <button v-on:click="sumarcantidad()" class="btn btn-success">Agregar mas producto</button>
              </div>
        </section>
</div>
</div>

</script>
</body>
</html>
  <script type="text/javascript" src="<?php echo base_url() ?>public/js/vue.js"></script>
   <script type="text/javascript" src="<?php echo base_url() ?>public/js/vue-resource.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url() ?>public/js/app.js"></script>