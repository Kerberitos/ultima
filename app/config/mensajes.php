<?php

return array(
		
	
	'ingresar'=> array(
			
		'activado'=>array(
			'estado'=>'activado',
			'titulo'=>'Bienvenido!',
			'contenido_principal'=>'Bienvenido a Miradita Loja',
			'contenido_secundario'=>'Esperamos que Miradita Loja sea de ayuda, para cualquier sugerencia o inconveniente 
									por favor comuníquese con nosotros'
		),
			
		'desactivado'=>array(
			'estado'=>'desactivado',
			'titulo'=>'Active su cuenta!',
			'contenido_principal'=>'Cuando se registró, un mensaje fue enviado a su correo electrónico ',
			'contenido_secundario'=>'Su cuenta en Miradita Loja no se encuentra aún activada, habíamos enviado 
									un enlace de activación a su correo, por favor es necesario que active su cuenta para 
									utilizar todas las funcionalidades de Miradita Loja, 
									si no ha llegado el correo electrónico revise en su carpeta de spam o solicite un 
									nuevo enlace de activación.'
		),
						
		'bloqueado'=>array(
			'estado'=>'bloqueado',
			'titulo'=>'Cuenta bloqueda!',
			'contenido_principal'=>'Su cuenta ha sido suspendida, por infringir alguna política de uso de la comunidad Miradita
									Loja',
			'contenido_secundario'=>'El Sitio web Miradita Loja bloquea una cuenta de usuario por las 
									siguientes razones: 
									<p> - Cuando supere el número de anuncios bloqueados permitidos 
										por infringir	las políticas de uso.</p>
									<p> - Cuando el usuario ha superado el número permitido de comentarios con contenido 
									que infringe alguna política de uso.</p> 
									<p>- Cuando el usuario abusa del sistema de denuncias, utilizándolo simplemente para realizar denuncias 
									innecesarias, tratando de perjudicar a otro usuario.</p>'
		),
		
		'eliminado'=>array(
			'estado'=>'eliminado',
			'titulo'=>'Cuenta eliminada!',
			'contenido_principal'=>'Ya contaba con una cuenta en Miradita Loja, pero la eliminó.',
			'contenido_secundario'=>'El correo electrónico que ingresó ya estaba con anterioridad asociado a una cuenta de 
									usuario en Miradita Loja, pero la eliminó, si desea activar nuevamente su cuenta, clic 
									en el botón reactivar cuenta.' 
		)
	),
		
	'registrar'=> array(
		
					
		'desactivado'=>array(
			'estado'=>'desactivado',
			'titulo'=>'Active su cuenta!',
			'contenido_principal'=>'El correo con que desea registrarse ya está en uso, pero la cuenta de Miradita 
									aún no ha sido activada, debería revisar su correo ',
			'contenido_secundario'=>'El correo electrónico ya está asociada a una cuenta en Miradita Loja, pero la cuenta
									 de usuario aún no está activada, revise el link de activación en su correo o puede
									 solicitar un	nuevo enlace de activación.'
		),
		
		'bloqueado'=>array(
			'estado'=>'bloqueado',
			'titulo'=>'Cuenta bloqueda!',
			'contenido_principal'=>'El correo con que desea registrarse se encuentra en uso, pero actualmente su cuenta en 
									Miradita Loja se encuentra bloqueada, por infringir alguna política de uso de la comunidad',
			'contenido_secundario'=>'El Sitio web Miradita Loja bloquea una cuenta de usuario por las 
									siguientes razones: 
									<p> - Cuando supere el número de anuncios bloqueados permitidos 
										por infringir	las políticas de uso.</p>
									<p> - Cuando el usuario ha superado el número permitido de comentarios con contenido 
									que infringe alguna política de uso.</p> 
									<p>- Cuando el usuario abusa del sistema de denuncias, utilizándolo simplemente para realizar denuncias 
									innecesarias, tratando de perjudicar a otro usuario.</p>'
		),
		
		'eliminado'=>array(
			'estado'=>'eliminado',
			'titulo'=>'Cuenta eliminada!',
			'contenido_principal'=>'Ya contaba con una cuenta en Miradita Loja, pero la eliminó.',
			'contenido_secundario'=>'El correo electrónico que ingresó ya estaba con anterioridad asociado a una cuenta 
									de usuario en Miradita Loja, pero la eliminó, si desea activar nuevamente su cuenta,
									haga clic en el botón reactivar cuenta.'
		)
	),
	
	'conectar'=> array(

		'bloqueado'=>array(
			'estado'=>'bloqueado',
			'titulo'=>'Cuenta bloqueda!',
			'contenido_principal'=>'La cuenta de correo que está utilizando en la red social si se encuentra registrada en 
									el sistema, pero actualmente su cuenta en Miradita Loja se encuentra bloqueada',
			'contenido_secundario'=>'El Sitio web Miradita Loja bloquea una cuenta de usuario por las 
									siguientes razones: 
									<p> - Cuando supere el número de anuncios bloqueados permitidos 
										por infringir	las políticas de uso.</p>
									<p> - Cuando el usuario ha superado el número permitido de comentarios con contenido 
									que infringe alguna política de uso.</p> 
									<p>- Cuando el usuario abusa del sistema de denuncias, utilizándolo simplemente para realizar denuncias 
									innecesarias, tratando de perjudicar a otro usuario.</p>'
		),
		
		'eliminado'=>array(
			'estado'=>'eliminado',
			'titulo'=>'Cuenta eliminada!',
			'contenido_principal'=>'Ya contaba con una cuenta en Miradita Loja, pero la eliminó.',
			'contenido_secundario'=>'La cuenta de correo electrónico que usa en la red social ya estaba con anterioridad
									 asociada a una cuenta de usuario en Miradita Loja, pero la eliminó, si desea activar
									 nuevamente su cuenta, haga clic en el botón reactivar cuenta.'
		)
	),
		
		
);