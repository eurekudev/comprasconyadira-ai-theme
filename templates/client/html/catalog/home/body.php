<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2020-2022
 */

$enc = $this->encoder();
$pos = 0;

/** client/html/catalog/home/imageset-sizes
 * Size hints for loading the appropriate catalog home image sizes
 *
 * Modern browsers can load images of different sizes depending on their viewport
 * size. This is also known as serving "responsive images" because on small
 * smartphone screens, only small images are loaded while full width images are
 * loaded on large desktop screens.
 *
 * A responsive image contains additional "srcset" and "sizes" attributes:
 *
 *  <img src="img.jpg"
 *  	srcset="img-small.jpg 240w, img-large.jpg 720w"
 *  	sizes="(max-width: 320px) 240px, 720px"
 *  >
 *
 * The images and their width in the "srcset" attribute are automatically added
 * based on the sizes of the generated preview images. The value of the "sizes"
 * attribute can't be determined by Aimeos because it depends on the used frontend
 * theme and the size of the images defined in the CSS file. This config setting
 * adds the required value for the "sizes" attribute.
 *
 * It's value consists of one or more comma separated rules with
 * - an optional CSS media query for the view port size
 * - the (max) width the image will be displayed within this viewport size
 *
 * Rules without a media query are independent of the view port size and must be
 * always at last because the rules are evaluated from left to right and the first
 * matching rule is used.
 *
 * The above example tells the browser:
 * - Up to 320px view port width use img-small.jpg
 * - Above 320px view port width use img-large.jpg
 *
 * For more information about the "sizes" attribute of the "img" HTML tag read:
 * {@link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/img#attr-sizes}
 *
 * @param string HTML image "sizes" attribute
 * @since 2021.04
 * @see client/html/common/imageset-sizes
 */

$lazy = false;


?>
<section
	class="aimeos catalog-home swiffy-slider slider-item-nogap slider-nav-animation slider-nav-autoplay slider-nav-autopause"
	data-slider-nav-autoplay-interval="4000" data-jsonurl="<?= $enc->attr( $this->link( 'client/jsonapi/url' ) ) ?>">

	<?php if( isset( $this->homeTree ) ) : ?>

	<div class="home-gallery <?= $enc->attr( $this->homeTree->getCode() ) ?> slider-container">

		<?php if( !( $mediaItems = $this->homeTree->getRefItems( 'media', 'stage', 'default' ) )->isEmpty() ) : ?>

		<div class="home-item home-image <?= $enc->attr( $this->homeTree->getCode() ) ?>">
			<div class="home-stage catalog-stage-image">

				<?php foreach( $mediaItems as $mediaItem ) : ?>

				<a class="stage-item"
					href="<?= $enc->attr( $this->link( 'client/html/catalog/tree/url', ['f_catid' => $this->homeTree->getId(), 'f_name' => $this->homeTree->getName( 'url' )] ) ) ?>">
					<img class="stage-image" loading="<?= $lazy ? 'lazy' : '' ?>"
						src="<?= $enc->attr( $this->content( $mediaItem->getPreview( true ), $mediaItem->getFileSystem() ) ) ?>"
						srcset="<?= $enc->attr( $this->imageset( $mediaItem->getPreviews( true ), $mediaItem->getFileSystem() ) ) ?>"
						alt="<?= $enc->attr( $mediaItem->getProperties( 'name' )->first() ) ?>">
					<div class="stage-text">
						<div class="stage-short">
							<?php foreach( $this->homeTree->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>
							<?= $textItem->getContent() ?>
							<?php endforeach ?>
						</div>
						<div class="btn">
							<?= $enc->html( $this->translate( 'client', 'Take a look' ) ) ?>
						</div>
					</div>
				</a>

				<?php $lazy = true ?>
				<?php endforeach ?>

			</div>
		</div>

		<?php endif ?>

		<?php foreach( $this->homeTree->getChildren() as $child ) : ?>
		<?php if( !( $mediaItems = $child->getRefItems( 'media', 'stage', 'default' ) )->isEmpty() ) : ?>

		<div class="home-item cat-image <?= $enc->attr( $child->getCode() ) ?>">
			<div class="home-stage catalog-stage-image">

				<?php foreach( $mediaItems as $mediaItem ) : ?>

				<a class="stage-item row"
					href="<?= $enc->attr( $this->link( 'client/html/catalog/tree/url', ['f_catid' => $child->getId(), 'f_name' => $child->getName( 'url' )] ) ) ?>">
					<img class="stage-image" loading="<?= $lazy ? 'lazy' : '' ?>"
						src="<?= $enc->attr( $this->content( $mediaItem->getPreview( true ), $mediaItem->getFileSystem() ) ) ?>"
						srcset="<?= $enc->attr( $this->imageset( $mediaItem->getPreviews( true ), $mediaItem->getFileSystem() ) ) ?>"
						alt="<?= $enc->attr( $mediaItem->getProperties( 'name' )->first() ) ?>">
					<div class="stage-text">
						<div class="stage-short">
							<?php foreach( $child->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>
							<?= $textItem->getContent() ?>
							<?php endforeach ?>
						</div>
						<div class="btn">
							<?= $enc->html( $this->translate( 'client', 'Take a look' ) ) ?>
						</div>
					</div>
				</a>

				<?php $lazy = true ?>
				<?php endforeach ?>

			</div>
		</div>

		<?php endif ?>
		<?php endforeach ?>

	</div>

	<button type="button" class="slider-nav" aria-label="Go to previous"></button>
	<button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>

	<?php endif ?>

</section>

<section class="aimeos catalog-who-i-am container">
	<div>
		<img class="poster-img" src="/vendor/shop/themes/comprasconyadira-ai-theme/assets/home_info/poster.gif" />
	</div>
	<div>
		<h5>¿Quien soy?</h5>
		<h1>Bienvenidos a la Tienda en Línea Compras con Yadira</h1>
		<p>Soy la Agente Comercial, encargada de gestionar su pedido, encargada de guiarlo en todo el proceso de compra
			desde que usted solicita la mercancía hasta que llegue a sus manos. Ofertamos una amplia variedad de productos
			desde prendas de vestir, comestibles, aseo, cosméticos, electrodomésticos, dispositivos móviles, motos eléctricas
			y bicicleta eléctrica.
		</p>
	</div>
</section>

<section class="aimeos container catalog-how-to-do">
	<div class="card">
		<div class="header">
			<i class="fa fa-3x fa-list"></i>
			<h2>Proceso</h2>
		</div>
		<p>El proceso de compra inicia en la recolección de toda la información referente a su pedido, datos personales y
			dirección de entrega; por último se tramita esta información a nuestros colaboradores en Panamá, encargados de
			comprar la mercancía de su elección.</p>
	</div>

	<div class="card">
		<div class="header">
			<i class="fa fa-3x fa-cart-plus"></i>
			<h2>Nuestos Productos</h2>
		</div>
		<p>Nuestras ofertas se basan en una variedad de productos en nuestros catálogos, cuyos precios principalmente en
			docenas le da flexibilidad al cliente de elegir y conformar sus propios combos ajustados a sus necesidades,
			también ofertamos combos sugeridos principalmente por las solicitudes de nuestros clientes que se caracterizan por
			ser económicos y variados.</p>
	</div>

	<div class="card">
		<div class="header">
			<i class="fa fa-3x fa-plane"></i>
			<h2>Envíos</h2>
		</div>
		<p>Nuestro principal envío es aéreo, aunque dependiendo del producto podemos sugerir el marítimo. Una vez nuestros
			colaboradores compran sus productos se hace una validación con el cliente de la lista de compras y el peso de los
			paquetes a enviar; una vez despachado, la entrega en Cuba durará entre 20 días hasta 3 meses, dependiendo de la
			provincia de destino y de la eficiencia de las instituciones estatales pertinentes como Correos de Cuba o
			Aerovaradero.</p>
	</div>

	<div class="card">
		<div class="header">
			<i class="fa fa-3x fa-file"></i>
			<h2>Códigos de rastreo</h2>
		</div>
		<p>Nuestros envíos cuentan con códigos de rastreos los cuales se les entrega al cliente una vez validado la lista de
			compras y pesos de los paquetes a enviar; estos códigos permiten darle más seguridad al cliente del estado de sus
			paquetes, y en cuanto a perdida o extravíos realizar los reclamos pertinentes para la reposición de su mercancía.
		</p>
	</div>
</section>
