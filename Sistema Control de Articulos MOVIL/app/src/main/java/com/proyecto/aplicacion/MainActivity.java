package com.proyecto.aplicacion;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.app.FragmentManager;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;

import android.widget.ImageView;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    FragmentManager manager = getSupportFragmentManager();
    ImageView muñeco;



    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        toolbar.setTitle("");



        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        cargarInfoPersonal();
        manager.beginTransaction().replace(R.id.contenedor, new Inicio()).commit();
        this.setTitle("");

    }

    private void cargarInfoPersonal() {
        NavigationView navigationView = findViewById(R.id.nav_view);
        View headerView = navigationView.getHeaderView(0);
        TextView nombreUsuario = headerView.findViewById(R.id.txtNombreUsuario);
        nombreUsuario.setText(Login.iniciarSesionJson.get(0).getNombreusuario());
        TextView rolUsuario = headerView.findViewById(R.id.txtRolUsuario);
        rolUsuario.setText(Login.iniciarSesionJson.get(0).getRolusuario());
        navigationView.setItemIconTintList(null);

        ImageView fotoPerfil = headerView.findViewById(R.id.imagenPerfil);

    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        //getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.historialNovedad) {

            manager.beginTransaction().replace(R.id.contenedor, new NovedadesRecientes()).commit();

        } else if (id == R.id.crearNovedad) {

            manager.beginTransaction().replace(R.id.contenedor, new CrearNovedad()).commit();

        } else if (id == R.id.crearActa) {
            manager.beginTransaction().replace(R.id.contenedor, new CrearActas()).commit();

        } else if (id == R.id.historialActas) {
            manager.beginTransaction().replace(R.id.contenedor, new ActasRecientes()).commit();
            this.setTitle("");


        } else if (id == R.id.cerrarSesion) {

            Intent intent = new Intent(MainActivity.this,
                    Login.class);
            startActivity(intent);

        } else if (id == R.id.acercaDe) {

            manager.beginTransaction().replace(R.id.contenedor, new AcercaDe()).commit();

        } else if (id == R.id.configuracion) {

            manager.beginTransaction().replace(R.id.contenedor, new CambiarPwd()).commit();

        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }




}








