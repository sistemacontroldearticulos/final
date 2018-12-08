package com.proyecto.aplicacion;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.transition.Slide;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewAnimationUtils;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.proyecto.aplicacion.Adaptadores.AdapterNovedadesRecientes;
import com.proyecto.aplicacion.Adaptadores.AdapterVerArticulos;
import com.proyecto.aplicacion.Adaptadores.AdapterVerArticulosNovedad;
import com.proyecto.aplicacion.Modelo.DetalleActas;
import com.proyecto.aplicacion.Modelo.IniciarSesionJson;
import com.proyecto.aplicacion.Modelo.Novedades;

import java.lang.reflect.Type;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

/**
 * Created by ADMIN on 29/10/2018.
 */

public class NovedadesRecientes extends Fragment {
    RecyclerView recyclerNovedades;
    ArrayList<com.proyecto.aplicacion.Modelo.IniciarSesionJson> iniciarSesionJsons;
    int item;
    ArrayList<Novedades> novedadesList;
    View view;
    RecyclerView recyclerArticulos;
    ArrayList<IniciarSesionJson> articulos;
    Button btnActualizarNovedades;
    RequestQueue queue;
    View vista;
    AlertDialog.Builder alerta;
    boolean validacion;
    NovedadesRecientes novedadesRecientes;
    Gson gson = new Gson();
    EditText txtFechaNovedadesDesde;
    CheckBox boxDias;
    ArrayList<Novedades> novedadesFiltro;
    ImageButton btnFiltroNovedades;

    EditText txtFechaNovedadesHasta;

    public static String tipoArticulo;
    public static String fichaNovedad;
    public static String imagenNovedad;
    public static String fechaNovedad;
    public static String tipoNovedad;
    public static String observacionnovedad;
    public static String equipoNovedad;
    public static String jornadaFicha;





    public static ProgressBar progressBarNovedadesRecientes;


    public static ArrayList<com.proyecto.aplicacion.Modelo.IniciarSesionJson> verNovedades = new ArrayList<>();


    public NovedadesRecientes() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(final LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {


        vista = inflater.inflate(R.layout.fragment_pantalla_inicial, container, false);
        inicializar();
        llenar();
        progressBarNovedadesRecientes.setVisibility(View.INVISIBLE);
        txtFechaNovedadesHasta.setEnabled(false);


        btnActualizarNovedades.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                actualizar();
            }
        });

        getActivity().setTitle("");


        txtFechaNovedadesDesde.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar calendario = Calendar.getInstance();
                int dia = calendario.get(Calendar.DAY_OF_MONTH);
                int mes = calendario.get(Calendar.MONTH);
                int año = calendario.get(Calendar.YEAR);

                DatePickerDialog datePickerDialog = new DatePickerDialog(getContext(), new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        month = month + 1;
                        txtFechaNovedadesDesde.setText(dayOfMonth + "/" + month + "/" + year);
                        txtFechaNovedadesHasta.setEnabled(true);

                    }
                }, dia, mes, año);
                datePickerDialog.show();

            }
        });

        txtFechaNovedadesHasta.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar calendario = Calendar.getInstance();
                int dia = calendario.get(Calendar.DAY_OF_MONTH);
                int mes = calendario.get(Calendar.MONTH);
                int año = calendario.get(Calendar.YEAR);

                DatePickerDialog datePickerDialog = new DatePickerDialog(getContext(), new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        month = month + 1;
                        txtFechaNovedadesHasta.setText(dayOfMonth + "/" + month + "/" + year);

                    }
                }, dia, mes, año);
                datePickerDialog.show();

            }
        });

        btnFiltroNovedades.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AdapterNovedadesRecientes adapterNovedadesRecientes;
                txtFechaNovedadesDesde.setError(null);
                novedadesFiltro.clear();
                String fechaDesde = txtFechaNovedadesDesde.getText().toString();
                String fechaHasta = txtFechaNovedadesHasta.getText().toString();
                if (fechaDesde.equals("") && fechaHasta.equals("")) {
                    llenar();

                } else if (fechaHasta.equals("")) {
                    for (int i = 0; i < novedadesList.size(); i++) {
                        Date dateArray = new Date();
                        Date fechaDesde1 = new Date();
                        Date fechaActual = new Date();
                        SimpleDateFormat dateFormat = new SimpleDateFormat("dd/MM/yyyy HH:mm");
                        SimpleDateFormat dateFormat1 = new SimpleDateFormat("dd/MM/yyyy");
                        try {
                            fechaDesde1 = dateFormat1.parse(fechaDesde);


                            String fechaA = dateFormat1.format(fechaActual);

                            fechaActual = dateFormat1.parse(fechaA);
                            dateArray = dateFormat.parse(novedadesList.get(i).getFecha());

                            String dateArray1 = dateFormat1.format(dateArray);
                            dateArray = dateFormat1.parse(dateArray1);

                            if (dateArray.after(fechaDesde1) && dateArray.before(fechaActual) || dateArray.equals(fechaDesde1) || dateArray.equals(fechaActual)) {
                                novedadesFiltro.add(novedadesList.get(i));
                            }
                        } catch (ParseException e) {
                            e.printStackTrace();
                        }


                    }

                    adapterNovedadesRecientes = new AdapterNovedadesRecientes(novedadesFiltro);
                    recyclerNovedades.setAdapter(adapterNovedadesRecientes);
                    txtFechaNovedadesDesde.setText("");
                    txtFechaNovedadesHasta.setText("");
                    txtFechaNovedadesHasta.setEnabled(false);
                    Toast.makeText(getContext(), novedadesFiltro.size() + " novedad(es) encontrada(s) en la fecha seleccionada", Toast.LENGTH_SHORT).show();
                    adapterNovedadesRecientes.setMlistener(new AdapterNovedadesRecientes.OnClickListener() {

                        public void itemClick(final int position, final View itemView) {

                            verNovedades.clear();


                            if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
                                Animator animator = ViewAnimationUtils.createCircularReveal(
                                        itemView,
                                        itemView.getWidth() / 2, itemView.getHeight() / 2, 0, itemView.getWidth()
                                );
                                animator.setDuration(500);
                                animator.start();
                                animator.addListener(new AnimatorListenerAdapter() {
                                    @Override
                                    public void onAnimationEnd(Animator animation) {
                                        super.onAnimationEnd(animation);

                                    }
                                });

                                String id = novedadesFiltro.get(position).getIdNovedad();
                                ArrayList<com.proyecto.aplicacion.Modelo.IniciarSesionJson> tmplista = Login.iniciarSesionJson;

                                for (int i = 0; i < tmplista.size(); i++) {
                                    com.proyecto.aplicacion.Modelo.IniciarSesionJson ini = tmplista.get(i);
                                    if (id.equals(Integer.toString(Integer.parseInt(ini.getIdnovedad())))) {
                                        verNovedades.add(ini);
                                        //Toast.makeText(getContext(), verNovedades.get(i).getTipoarticulo(), Toast.LENGTH_SHORT).show();


                                    }
                                }

                                Constants.bandera = true;
                                final Dialog dialog = new Dialog(getContext());
                                dialog.setContentView(R.layout.popup_novedades);
                                //dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

                                articulos = NovedadesRecientes.verNovedades;


                                recyclerArticulos = dialog.findViewById(R.id.recyclerViewArticulos);
                                recyclerArticulos.setLayoutManager(new LinearLayoutManager(dialog.getContext(), LinearLayoutManager.VERTICAL, false));
                                recyclerArticulos.setHasFixedSize(true);
                                AdapterVerArticulos adapterVerArticulos = new AdapterVerArticulos(articulos);
                                recyclerArticulos.setAdapter(adapterVerArticulos);


                                dialog.setCancelable(true);

                                dialog.show();


                            }


                        }
                    });
                } else {

                    for (final int[] i = {0}; i[0] < novedadesList.size(); i[0]++) {
                        Date dateArray = new Date();
                        Date fechaDesde1 = new Date();
                        Date fechaHasta1 = new Date();
                        SimpleDateFormat dateFormat = new SimpleDateFormat("dd/MM/yyyy HH:mm");
                        SimpleDateFormat dateFormat1 = new SimpleDateFormat("dd/MM/yyyy");
                        try {
                            fechaDesde1 = dateFormat1.parse(fechaDesde);
                            fechaHasta1 = dateFormat1.parse(fechaHasta);

                            dateArray = dateFormat.parse(novedadesList.get(i[0]).getFecha());

                            String dateArray1 = dateFormat1.format(dateArray);
                            dateArray = dateFormat1.parse(dateArray1);
                            int validacion = fechaDesde1.compareTo(fechaHasta1);
                            if (validacion > 0) {
                                alerta.setTitle("Fecha Incorrecta");
                                alerta.setMessage("La fecha límite no puede ser menor a la fecha de origen");
                                alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialog, int which) {
                                        dialog.cancel();
                                        llenar();

                                    }
                                });
                                alerta.create();
                                alerta.show();
                                i[0] = novedadesList.size() + 1;
                            } else if (dateArray.after(fechaDesde1) && dateArray.before(fechaHasta1) || dateArray.equals(fechaDesde1) || dateArray.equals(fechaHasta1)) {
                                novedadesFiltro.add(novedadesList.get(i[0]));
                            }
                        } catch (ParseException e) {
                            e.printStackTrace();
                        }


                    }


                    adapterNovedadesRecientes = new AdapterNovedadesRecientes(novedadesFiltro);
                    recyclerNovedades.setAdapter(adapterNovedadesRecientes);
                    txtFechaNovedadesDesde.setText("");
                    txtFechaNovedadesHasta.setText("");
                    txtFechaNovedadesHasta.setEnabled(false);
                    Toast.makeText(getContext(), novedadesFiltro.size() + " novedad(es) encontrada(s) en la fecha seleccionada", Toast.LENGTH_SHORT).show();
                    adapterNovedadesRecientes.setMlistener(new AdapterNovedadesRecientes.OnClickListener() {

                        public void itemClick(final int position, final View itemView) {

                            verNovedades.clear();


                            if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
                                Animator animator = ViewAnimationUtils.createCircularReveal(
                                        itemView,
                                        itemView.getWidth() / 2, itemView.getHeight() / 2, 0, itemView.getWidth()
                                );
                                animator.setDuration(500);
                                animator.start();
                                animator.addListener(new AnimatorListenerAdapter() {
                                    @Override
                                    public void onAnimationEnd(Animator animation) {
                                        super.onAnimationEnd(animation);

                                    }
                                });

                                String id = novedadesFiltro.get(position).getIdNovedad();
                                ArrayList<com.proyecto.aplicacion.Modelo.IniciarSesionJson> tmplista = Login.iniciarSesionJson;

                                for (int i = 0; i < tmplista.size(); i++) {
                                    com.proyecto.aplicacion.Modelo.IniciarSesionJson ini = tmplista.get(i);
                                    if (id.equals(Integer.toString(Integer.parseInt(ini.getIdnovedad())))) {
                                        verNovedades.add(ini);
                                        //Toast.makeText(getContext(), verNovedades.get(i).getTipoarticulo(), Toast.LENGTH_SHORT).show();


                                    }
                                }

                                Constants.bandera = true;
                                final Dialog dialog = new Dialog(getContext());
                                dialog.setContentView(R.layout.popup_novedades);
                                //dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

                                articulos = NovedadesRecientes.verNovedades;


                                recyclerArticulos = dialog.findViewById(R.id.recyclerViewArticulos);
                                recyclerArticulos.setLayoutManager(new LinearLayoutManager(dialog.getContext(), LinearLayoutManager.VERTICAL, false));
                                recyclerArticulos.setHasFixedSize(true);
                                AdapterVerArticulos adapterVerArticulos = new AdapterVerArticulos(articulos);
                                recyclerArticulos.setAdapter(adapterVerArticulos);


                                dialog.setCancelable(true);

                                dialog.show();


                            }


                        }
                    });
                }


            }

        });


        return vista;

    }

    private void inicializar() {
        btnActualizarNovedades = vista.findViewById(R.id.btnActualizarNovedades);
        alerta = new AlertDialog.Builder(getContext());
        txtFechaNovedadesDesde = vista.findViewById(R.id.txtFechaNovedadesDesde);
        txtFechaNovedadesHasta = vista.findViewById(R.id.txtFechaNovedadesHasta);
        progressBarNovedadesRecientes = vista.findViewById(R.id.progresBarNovedadesRecientes);


        novedadesFiltro = new ArrayList<>();
        btnFiltroNovedades = vista.findViewById(R.id.btnFiltroNovedades);
        recyclerNovedades = vista.findViewById(R.id.recyclerNovedades);
    }

    private void actualizar() {
        progressBarNovedadesRecientes.setVisibility(View.VISIBLE);
        getActivity().getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
        getActivity().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));

        vista.setEnabled(false);
        novedadesRecientes = new NovedadesRecientes();
        queue = Volley.newRequestQueue(getContext());
        ;

        String url = Constants.url + "login/" + Login.numDocumento + "&" + Login.encriptar(Login.contras);


        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {


                        Type type = new TypeToken<List<IniciarSesionJson>>() {
                        }.getType();
                        Login.iniciarSesionJson = gson.fromJson(response, type);

                        Toast.makeText(getContext(), "Lista de Novedades Actualizada Correctamente", Toast.LENGTH_SHORT).show();
                        FragmentTransaction ft = getFragmentManager().beginTransaction();
                        ft.detach(NovedadesRecientes.this).attach(NovedadesRecientes.this).commit();


                        progressBarNovedadesRecientes.setVisibility(View.INVISIBLE);
                        getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);


                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

                Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                progressBarNovedadesRecientes.setVisibility(View.INVISIBLE);
                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);


            }
        });
        queue.add(stringRequest);
    }

    public void llenar() {
        item = R.layout.item_list_novedades_recientes;
        iniciarSesionJsons = Login.iniciarSesionJson;

        if (iniciarSesionJsons.get(0).getIdnovedad() == null) {

            alerta.setTitle("INFORMACIÓN");
            alerta.setMessage("Usted no ha registrado ninguna novedad hasta el momento");
            alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    dialog.cancel();
                }
            });
            alerta.create();
            alerta.show();
        } else {

            recyclerNovedades.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
            recyclerNovedades.setHasFixedSize(true);

            novedadesList = new ArrayList<>();


            int[] numeroArticulos = new int[iniciarSesionJsons.size()];
            List<String> listaIdNovedades = new ArrayList<>();
            List<String> listaFechaN = new ArrayList<>();
            List<String> listaNombreAm = new ArrayList<>();
            List<String> listEstado= new ArrayList<>();

            String tmp = "";
            for (int i = 0; i < iniciarSesionJsons.size(); i++) {
                int a = 0;
                if (!listaIdNovedades.contains(iniciarSesionJsons.get(i).getIdnovedad())) {
                    listaIdNovedades.add(iniciarSesionJsons.get(i).getIdnovedad());
                    listaFechaN.add(iniciarSesionJsons.get(i).getFechanovedad());
                    listaNombreAm.add(iniciarSesionJsons.get(i).getNombreambiente());
                    listEstado.add(iniciarSesionJsons.get(i).getEstado());
                    numeroArticulos[listaIdNovedades.size() - 1] = 1;
                } else {
                    numeroArticulos[listaIdNovedades.size() - 1]++;
                }
            }

            for (int i = 0; i < listaIdNovedades.size(); i++) {


            }

            for (int i = 0; i < numeroArticulos.length; i++) {


            }

            Date date = new Date();
            SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
            SimpleDateFormat dateFormat1 = new SimpleDateFormat("dd/MM/yyyy HH:mm");

            for (int i = 0; i < listaIdNovedades.size(); i++) {
                Novedades novedades = new Novedades();
                novedades.setIdNovedad(listaIdNovedades.get(i));
                try {
                    date = dateFormat.parse(listaFechaN.get(i));
                    novedades.setFecha(dateFormat1.format(date));

                } catch (Exception e) {


                }
                novedades.setAmbiente(listaNombreAm.get(i));
                novedades.setArticulos(numeroArticulos[i]);
                novedades.setEstado(listEstado.get(i));
                novedadesList.add(novedades);
            }


            AdapterNovedadesRecientes adapterNovedadesRecientes = new AdapterNovedadesRecientes(novedadesList);
            recyclerNovedades.setAdapter(adapterNovedadesRecientes);


            adapterNovedadesRecientes.setMlistener(new AdapterNovedadesRecientes.OnClickListener() {

                public void itemClick(final int position, final View itemView) {

                    verNovedades.clear();


                    if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
                        Animator animator = ViewAnimationUtils.createCircularReveal(
                                itemView,
                                itemView.getWidth() / 2, itemView.getHeight() / 2, 0, itemView.getWidth()
                        );
                        animator.setDuration(500);
                        animator.start();
                        animator.addListener(new AnimatorListenerAdapter() {
                            @Override
                            public void onAnimationEnd(Animator animation) {
                                super.onAnimationEnd(animation);

                            }
                        });

                        String id = novedadesList.get(position).getIdNovedad();
                        ArrayList<com.proyecto.aplicacion.Modelo.IniciarSesionJson> tmplista = Login.iniciarSesionJson;

                        for (int i = 0; i < tmplista.size(); i++) {
                            com.proyecto.aplicacion.Modelo.IniciarSesionJson ini = tmplista.get(i);
                            if (id.equals(Integer.toString(Integer.parseInt(ini.getIdnovedad())))) {
                                verNovedades.add(ini);
                                //Toast.makeText(getContext(), verNovedades.get(i).getTipoarticulo(), Toast.LENGTH_SHORT).show();


                            }
                        }

                        Constants.bandera = true;
                        final Dialog dialog = new Dialog(getContext());
                        dialog.setContentView(R.layout.popup_novedades);
                        //dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));



                        articulos = NovedadesRecientes.verNovedades;


                        recyclerArticulos = dialog.findViewById(R.id.recyclerViewArticulos);
                        recyclerArticulos.setLayoutManager(new LinearLayoutManager(dialog.getContext(), LinearLayoutManager.VERTICAL, false));
                        recyclerArticulos.setHasFixedSize(true);
                        AdapterVerArticulos adapterVerArticulos = new AdapterVerArticulos(articulos);
                        recyclerArticulos.setAdapter(adapterVerArticulos);

                        adapterVerArticulos.setMlistener(new AdapterNovedadesRecientes.OnClickListener() {
                            @Override
                            public void itemClick(int position, View itemView) {



                                tipoArticulo=articulos.get(position).getTipoarticulo();
                                fichaNovedad=articulos.get(position).getNumeroficha();
                                imagenNovedad=articulos.get(position).getFotonovedad();
                                fechaNovedad=articulos.get(position).getFechanovedad();
                                tipoNovedad=articulos.get(position).getTiponovedad();
                                observacionnovedad=articulos.get(position).getObservacionnovedad();
                                equipoNovedad=articulos.get(position).getNombreequipo();
                                jornadaFicha=articulos.get(position).getJornadaficha();
                                dialog.cancel();

                                Fragment f =new DetalleNovedad();
                                f.setEnterTransition(new Slide(Gravity.RIGHT));
                                f.setExitTransition(new Slide(Gravity.LEFT));

                                getFragmentManager().beginTransaction()
                                        .replace(R.id.contenedor, f,"main").addToBackStack("main")
                                        .commit();


                            }
                        });


                        dialog.setCancelable(true);

                        dialog.show();


                    }


                }
            });

        }
    }

}
