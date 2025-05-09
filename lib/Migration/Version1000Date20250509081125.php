<?php

declare(strict_types=1);

namespace OCA\Cpx\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

class Version1000Date20250509081125 extends SimpleMigrationStep {

	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		$schema = $schemaClosure();

		// CPU
		if (!$schema->hasTable('CPU')) {
			$table = $schema->createTable('CPU');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('CPU', 'string');
			$table->setPrimaryKey(['id']);
			$table->addUniqueIndex(['CPU']);
		}

		// MCPU
		if (!$schema->hasTable('MCPU')) {
			$table = $schema->createTable('MCPU');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('MCPU', 'string');
			$table->setPrimaryKey(['id']);
			$table->addUniqueIndex(['MCPU']);
		}

		// RAM
		if (!$schema->hasTable('RAM')) {
			$table = $schema->createTable('RAM');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('CAPACIDAD', 'string');
			$table->setPrimaryKey(['id']);
			$table->addUniqueIndex(['CAPACIDAD']);
		}

		// DiscoDuro
		if (!$schema->hasTable('DiscoDuro')) {
			$table = $schema->createTable('DiscoDuro');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('CAPACIDAD', 'string');
			$table->addColumn('Tipo', 'string');
			$table->setPrimaryKey(['id']);
		}

		// ModeloLaptop
		if (!$schema->hasTable('ModeloLaptop')) {
			$table = $schema->createTable('ModeloLaptop');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('modelo', 'string');
			$table->setPrimaryKey(['id']);
		}

		// Laptop
		if (!$schema->hasTable('Laptop')) {
			$table = $schema->createTable('Laptop');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('Historia', 'integer');
			$table->addColumn('User', 'string');
			$table->addColumn('ST', 'string');
			$table->addColumn('NT', 'string');
			$table->addColumn('ID_CPU', 'integer');
			$table->addColumn('MCPU', 'integer');
			$table->addColumn('RAM', 'integer');
			$table->addColumn('DD', 'integer');
			$table->addColumn('MODELO', 'integer');
			$table->addColumn('OBSERVACIONES', 'text', ['notnull' => false]);
			$table->addColumn('created_at', 'datetime');
			$table->addColumn('updated_at', 'datetime');
			$table->setPrimaryKey(['id']);
			$table->addUniqueIndex(['Historia']);
			$table->addUniqueIndex(['ST']);
			$table->addUniqueIndex(['NT']);
		}

		// Relaciones foráneas Laptop
		$table = $schema->getTable('Laptop');
		$table->addForeignKeyConstraint($schema->getTable('CPU'), ['ID_CPU'], ['id']);
		$table->addForeignKeyConstraint($schema->getTable('MCPU'), ['MCPU'], ['id']);
		$table->addForeignKeyConstraint($schema->getTable('RAM'), ['RAM'], ['id']);
		$table->addForeignKeyConstraint($schema->getTable('DiscoDuro'), ['DD'], ['id']);
		$table->addForeignKeyConstraint($schema->getTable('ModeloLaptop'), ['MODELO'], ['id']);
		
		// OpcionesSimples
		if (!$schema->hasTable('OpcionesSimples')) {
			$table = $schema->createTable('OpcionesSimples');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'string');
			$table->setPrimaryKey(['id']);
		}

		// OpcionesMB
		if (!$schema->hasTable('OpcionesMB')) {
			$table = $schema->createTable('OpcionesMB');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'string');
			$table->setPrimaryKey(['id']);
		}

		// Teclado
		if (!$schema->hasTable('Teclado')) {
			$table = $schema->createTable('Teclado');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'integer');
			$table->setPrimaryKey(['id']);
		}

		// Display
		if (!$schema->hasTable('Display')) {
			$table = $schema->createTable('Display');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'integer');
			$table->setPrimaryKey(['id']);
		}

		// Clicks
		if (!$schema->hasTable('Clicks')) {
			$table = $schema->createTable('Clicks');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'integer');
			$table->setPrimaryKey(['id']);
		}

		// MB (Mother Board)
		if (!$schema->hasTable('MB')) {
			$table = $schema->createTable('MB');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'integer');
			$table->setPrimaryKey(['id']);
		}

		// Relaciones con OpcionesSimples y OpcionesMB
		$schema->getTable('Teclado')->addForeignKeyConstraint($schema->getTable('OpcionesSimples'), ['opcion'], ['id']);
		$schema->getTable('Display')->addForeignKeyConstraint($schema->getTable('OpcionesSimples'), ['opcion'], ['id']);
		$schema->getTable('Clicks')->addForeignKeyConstraint($schema->getTable('OpcionesSimples'), ['opcion'], ['id']);
		$schema->getTable('MB')->addForeignKeyConstraint($schema->getTable('OpcionesMB'), ['opcion'], ['id']);
		
		// OpcionesDañoMB
		if (!$schema->hasTable('OpcionesDañoMB')) {
			$table = $schema->createTable('OpcionesDañoMB');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'string');
			$table->setPrimaryKey(['id']);
		}

		// OpcionesOtros
		if (!$schema->hasTable('OpcionesOtros')) {
			$table = $schema->createTable('OpcionesOtros');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'string');
			$table->setPrimaryKey(['id']);
		}

		// OpcionesIdiomaTeclado
		if (!$schema->hasTable('OpcionesIdiomaTeclado')) {
			$table = $schema->createTable('OpcionesIdiomaTeclado');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'string');
			$table->setPrimaryKey(['id']);
		}

		// Status
		if (!$schema->hasTable('Status')) {
			$table = $schema->createTable('Status');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('Opcion', 'string');
			$table->setPrimaryKey(['id']);
		}

		// Historico
		if (!$schema->hasTable('Historico')) {
			$table = $schema->createTable('Historico');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('campo', 'string');
			$table->addColumn('valor', 'string');
			$table->addColumn('fecha', 'datetime');
			$table->setPrimaryKey(['id']);
		}

		// Actividades
		if (!$schema->hasTable('Actividades')) {
			$table = $schema->createTable('Actividades');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('Opcion', 'string');
			$table->addColumn('Tiempo', 'integer');
			$table->setPrimaryKey(['id']);
		}

		// Grados
		if (!$schema->hasTable('Grados')) {
			$table = $schema->createTable('Grados');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('Grado', 'string');
			$table->setPrimaryKey(['id']);
		}
		// Plasticos
		if (!$schema->hasTable('Plasticos')) {
			$table = $schema->createTable('Plasticos');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('Historia', 'integer');
			$table->addColumn('CA', 'integer');
			$table->addColumn('CB', 'integer');
			$table->addColumn('CC', 'integer');
			$table->addColumn('CD', 'integer');
			$table->setPrimaryKey(['id']);
			$table->addUniqueIndex(['Historia']);
		}

		// Otros
		if (!$schema->hasTable('Otros')) {
			$table = $schema->createTable('Otros');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('opcion', 'integer');
			$table->setPrimaryKey(['id']);
		}

		// Almacenes
		if (!$schema->hasTable('Almacenes')) {
			$table = $schema->createTable('Almacenes');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('nombre', 'string');
			$table->setPrimaryKey(['id']);
		}

		// Tarima
		if (!$schema->hasTable('Tarima')) {
			$table = $schema->createTable('Tarima');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('almacen_id', 'integer');
			$table->addColumn('nombre', 'string');
			$table->setPrimaryKey(['id']);
		}

		// RackAlmacen
		if (!$schema->hasTable('RackAlmacen')) {
			$table = $schema->createTable('RackAlmacen');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('nombre', 'string');
			$table->setPrimaryKey(['id']);
		}

		// RackProduccion
		if (!$schema->hasTable('RackProduccion')) {
			$table = $schema->createTable('RackProduccion');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('nombre', 'string');
			$table->setPrimaryKey(['id']);
		}

		// Relaciones Tarima → Almacenes
		$schema->getTable('Tarima')->addForeignKeyConstraint($schema->getTable('Almacenes'), ['almacen_id'], ['id']);

		// Pedido
		if (!$schema->hasTable('Pedido')) {
			$table = $schema->createTable('Pedido');
			$table->addColumn('id', 'integer', ['autoincrement' => true]);
			$table->addColumn('producto', 'string');
			$table->addColumn('cantidad', 'integer');
			$table->addColumn('fecha', 'datetime');
			$table->setPrimaryKey(['id']);
		}

		return $schema;
	}
}

