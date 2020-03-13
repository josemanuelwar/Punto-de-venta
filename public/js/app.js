var app = new Vue({
  el: '#app',
  data: {
    message: 'Registro de productos',
    productos:{
    	nombre:null,
    	cantidad:null,
    	precio:null,
      seleccion:null
    },
     producto: [],
     ban:false,
     but:true,
     ban1:false,
     erros:[],
     bandera:0,
     

  },///fin de data
  methods: {
  	  crearproducto: function(){
          this.erros=[];
         if(!this.productos.nombre){
            this.erros.push("El nombre es requerido");
            this.bandera=1;
            console.log(this.erros);
         }
         if(!this.productos.cantidad){
            this.erros.push("El Precio es requerido");
            this.bandera=1;
            console.log(this.erros);
         }
         if(!this.productos.Precio){
            this.erros.push("EL cantidad es requerido");
            this.bandera=1;
            console.log(this.erros);
         }
         if(this.bandera != 1){
            this.$http.post('http://localhost/Punto-de-venta/Productos/registraproductosvue/', this.productos).then(function(){
            this.productos.nombre = '';
            this.productos.cantidad = '';
            this.productos.precio = '';
            this.recuperarProducto();
            }, function(){
            alert('No se ha podido crear la tarea.');
         });
   }
  	},
  	recuperarProducto: function(){
         this.$http.get('http://localhost/Punto-de-venta/Productos/recupearproductos').then(function(respuesta){
            this.producto = respuesta.body;
         }, function(){
            alert('No se han podido recuperar los estados.');
         });
      },
      mostrarcampos: function(){
        this.ban=true;
        this.but=false;
      },
      
      actulizar:function(){
        this.$http.post('http://localhost/Punto-de-venta/Productos/Actualizarproducto/', this.productos).then(function(){
            this.productos.nombre = '';
            this.productos.cantidad = '';
            this.productos.precio = '';
            this.recuperarProducto();
            this.ban=false;
            this.but=true;
         }, function(){
            alert('No se ha podido crear la tarea.');
         
      });
      },
      agregarproducto:function(){
        this.ban=false;
        this.but=false;
        this.ban1=true;
      },
      sumarcantidad:function(){
        this.$http.post('http://localhost/Punto-de-venta/Productos/Actulizarcantidad/', this.productos).then(function(){
            this.productos.nombre = '';
            this.productos.cantidad = '';
            this.productos.precio = '';
            this.ban=false;
            this.but=true;
            this.ban1=false;
            this.recuperarProducto();
       
         }, function(){
            alert('No se ha podido crear la tarea.');
         
        });
      }

  },//fin del metodos
  created: function(){
      this.recuperarProducto();
      //this.recuperarTareas();
   }
})