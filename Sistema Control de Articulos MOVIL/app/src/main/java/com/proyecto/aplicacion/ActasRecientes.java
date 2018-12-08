package com.proyecto.aplicacion;


import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewAnimationUtils;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;
import com.proyecto.aplicacion.Adaptadores.AdapterActas;
import com.proyecto.aplicacion.Adaptadores.AdapterDetalleActas;
import com.proyecto.aplicacion.Modelo.ActasJson;
import com.proyecto.aplicacion.Modelo.DetalleActas;
import com.proyecto.aplicacion.Modelo.IniciarSesionJson;

import java.lang.reflect.Type;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;


/**
 * A simple {@link Fragment} subclass.
 */
public class ActasRecientes extends Fragment {

    RecyclerView recyclerActas;
    ArrayList<IniciarSesionJson> iniciarSesionJsons;
    int item;
    ArrayList<ActasJson> actasRecientes;
    View view;
    RecyclerView recyclerArticulos;
    ArrayList<ActasJson> actasJsons;
    RequestQueue queue;

    AlertDialog.Builder alerta;
    ArrayList<DetalleActas> detallesActas = new ArrayList<>();
    Button btnActualizarActas;
    Gson gson = new Gson();
    ActasRecientes clase;
    ImageButton btnFiltroActas;
    ArrayList<ActasJson> actasJsons1;
    AdapterActas adapterActas;
    RecyclerView recyclerViewActas;

    EditText txtFechaActasDesde;
    EditText txtFechaActasHasta;
    ProgressBar progressBar;


    public ActasRecientes() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {



        view = inflater.inflate(R.layout.fragment_actas_recientes, container, false);




        inicializar();
        llenar();

        progressBar.setVisibility(View.INVISIBLE);


        btnActualizarActas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                actualizar();

            }
        });


        txtFechaActasDesde.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final Calendar calendario = Calendar.getInstance();
                final int dia = calendario.get(Calendar.DAY_OF_MONTH);
                final int mes = calendario.get(Calendar.MONTH);
                final int año = calendario.get(Calendar.YEAR);

                DatePickerDialog datePickerDialog = new DatePickerDialog(getContext(), new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
                        month = month + 1;
                        txtFechaActasDesde.setText(dayOfMonth + "/" + month + "/" + year);
                        txtFechaActasHasta.setEnabled(true);

                    }
                }, dia, mes, año);
                datePickerDialog.show();
            }
        });

        txtFechaActasHasta.setOnClickListener(new View.OnClickListener() {
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
                        txtFechaActasHasta.setText(dayOfMonth + "/" + month + "/" + year);
                        txtFechaActasHasta.setEnabled(true);


                    }
                }, dia, mes, año);
                datePickerDialog.show();
            }
        });


        btnFiltroActas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                actasJsons1.clear();
                String fechaActaDesde = txtFechaActasDesde.getText().toString();
                String fechaActaHasta = txtFechaActasHasta.getText().toString();
                if (fechaActaDesde.equals("") && fechaActaHasta.equals("")) {
                    llenar();

                } else if (fechaActaHasta.equals("")) {


                    for (int i = 0; i < Login.actasJsons.size(); i++) {
                        Date dateArray = new Date();
                        Date fechaDesde = new Date();
                        Date fechaActual = new Date();

                        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                        SimpleDateFormat dateFormat1 = new SimpleDateFormat("dd/MM/yyyy");
                        try {
                            fechaDesde = dateFormat1.parse(fechaActaDesde);


                            String fechaA = dateFormat1.format(fechaActual);

                            fechaActual = dateFormat1.parse(fechaA);
                            dateArray = dateFormat.parse(Login.actasJsons.get(i).getFechaacta());

                            String dateArray1 = dateFormat1.format(dateArray);
                            dateArray = dateFormat1.parse(dateArray1);

                            if (dateArray.after(fechaDesde) && dateArray.before(fechaActual) || dateArray.equals(fechaDesde) || dateArray.equals(fechaActual)) {
                                actasJsons1.add(Login.actasJsons.get(i));
                            }
                        } catch (ParseException e) {
                            e.printStackTrace();
                        }


                    }

                    adapterActas = new AdapterActas(actasJsons1);
                    recyclerActas.setAdapter(adapterActas);
                    txtFechaActasDesde.setText("");
                    txtFechaActasHasta.setText("");
                    Toast.makeText(getContext(), actasJsons1.size() + " acta(s) encontrada(s) en la fecha seleccionada", Toast.LENGTH_SHORT).show();
                    adapterActas.setMlistener(new AdapterActas.OnClickListener() {

                        public void itemClick(final int position, final View itemView) {

                            //verNovedades.clear();
                            detallesActas.clear();


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

                                String id = actasJsons1.get(position).getIdacta();
                                ArrayList<ActasJson> tmplista = Login.actasJsons;

                                for (int i = 0; i < tmplista.size(); i++) {
                                    ActasJson ini = tmplista.get(i);
                                    if (id.equals(Integer.toString(Integer.parseInt(ini.getIdacta())))) {

                                        DetalleActas detalleActas1 = new DetalleActas();
                                        detalleActas1.setAmbiente(tmplista.get(i).getNombreambiente());
                                        detalleActas1.setEquipo(tmplista.get(i).getNombreequipo());
                                        detalleActas1.setFicha(tmplista.get(i).getNumeroficha());
                                        detalleActas1.setNombre(tmplista.get(i).getNombreaprendiz());
                                        detallesActas.add(detalleActas1);
                                        //Toast.makeText(getContext(), verNovedades.get(i).getTipoarticulo(), Toast.LENGTH_SHORT).show();


                                    }
                                }

                                Constants.bandera = true;
                                final Dialog dialog = new Dialog(getContext());
                                dialog.setContentView(R.layout.popup_novedades);
                                //dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                                TextView txtAmbiente = dialog.findViewById(R.id.txtArticulo);
                                TextView txtFicha = dialog.findViewById(R.id.txtTipoNovedad);
                                TextView txtEquipo = dialog.findViewById(R.id.txtEquipo);
                                TextView txtNombre = dialog.findViewById(R.id.txtJornada);

                                txtAmbiente.setText("AMBIENTE");
                                txtFicha.setText("FICHA");
                                txtNombre.setText("NOMBRE");


                                recyclerArticulos = dialog.findViewById(R.id.recyclerViewArticulos);
                                recyclerArticulos.setLayoutManager(new LinearLayoutManager(dialog.getContext(), LinearLayoutManager.VERTICAL, false));
                                recyclerArticulos.setHasFixedSize(true);
                                AdapterDetalleActas adapterDetalleActas = new AdapterDetalleActas(detallesActas);
                                recyclerArticulos.setAdapter(adapterDetalleActas);


                                dialog.setCancelable(true);

                                dialog.show();


                            }
                        }

                    });

                } else {

                    for (int i = 0; i < Login.actasJsons.size(); i++) {
                        Date dateArray = new Date();
                        Date fechaDesde1 = new Date();
                        Date fechaHasta1 = new Date();
                        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                        SimpleDateFormat dateFormat1 = new SimpleDateFormat("dd/MM/yyyy");
                        try {
                            fechaDesde1 = dateFormat1.parse(fechaActaDesde);
                            fechaHasta1 = dateFormat1.parse(fechaActaHasta);

                            dateArray = dateFormat.parse(Login.actasJsons.get(i).getFechaacta());

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
                                i = Login.actasJsons.size() + 1;
                                alerta.show();

                            } else if (dateArray.after(fechaDesde1) && dateArray.before(fechaHasta1) || dateArray.equals(fechaDesde1) || dateArray.equals(fechaHasta1)) {
                                actasJsons1.add(Login.actasJsons.get(i));
                            }
                        } catch (ParseException e) {
                            e.printStackTrace();
                        }


                    }
                    adapterActas = new AdapterActas(actasJsons1);
                    recyclerActas.setAdapter(adapterActas);
                    txtFechaActasDesde.setText("");
                    txtFechaActasHasta.setText("");
                    Toast.makeText(getContext(), actasJsons1.size() + " acta(s) encontrada(s) en la fecha seleccionada", Toast.LENGTH_SHORT).show();
                    adapterActas.setMlistener(new AdapterActas.OnClickListener() {

                        public void itemClick(final int position, final View itemView) {

                            //verNovedades.clear();
                            detallesActas.clear();


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

                                String id = actasJsons1.get(position).getIdacta();
                                ArrayList<ActasJson> tmplista = Login.actasJsons;

                                for (int i = 0; i < tmplista.size(); i++) {
                                    ActasJson ini = tmplista.get(i);
                                    if (id.equals(Integer.toString(Integer.parseInt(ini.getIdacta())))) {

                                        DetalleActas detalleActas1 = new DetalleActas();
                                        detalleActas1.setAmbiente(tmplista.get(i).getNombreambiente());
                                        detalleActas1.setEquipo(tmplista.get(i).getNombreequipo());
                                        detalleActas1.setFicha(tmplista.get(i).getNumeroficha());
                                        detalleActas1.setNombre(tmplista.get(i).getNombreaprendiz());
                                        detallesActas.add(detalleActas1);
                                        //Toast.makeText(getContext(), verNovedades.get(i).getTipoarticulo(), Toast.LENGTH_SHORT).show();


                                    }
                                }

                                Constants.bandera = true;
                                final Dialog dialog = new Dialog(getContext());
                                dialog.setContentView(R.layout.popup_novedades);
                                //dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                                TextView txtAmbiente = dialog.findViewById(R.id.txtArticulo);
                                TextView txtFicha = dialog.findViewById(R.id.txtTipoNovedad);
                                TextView txtEquipo = dialog.findViewById(R.id.txtEquipo);
                                TextView txtNombre = dialog.findViewById(R.id.txtJornada);

                                txtAmbiente.setText("AMBIENTE");
                                txtFicha.setText("FICHA");
                                txtNombre.setText("NOMBRE");


                                recyclerArticulos = dialog.findViewById(R.id.recyclerViewArticulos);
                                recyclerArticulos.setLayoutManager(new LinearLayoutManager(dialog.getContext(), LinearLayoutManager.VERTICAL, false));
                                recyclerArticulos.setHasFixedSize(true);
                                AdapterDetalleActas adapterDetalleActas = new AdapterDetalleActas(detallesActas);
                                recyclerArticulos.setAdapter(adapterDetalleActas);


                                dialog.setCancelable(true);

                                dialog.show();


                            }
                        }

                    });
                }

            }
        });


        getActivity().setTitle("Actas Recientes");
        // Inflate the layout for this fragment

        llenar();
        return view;


    }

    private void inicializar() {
        actasJsons = new ArrayList<>();
        btnActualizarActas = view.findViewById(R.id.btnActualizarActas);
        txtFechaActasDesde = view.findViewById(R.id.txtFechaActasDesde);
        btnFiltroActas = view.findViewById(R.id.btnFiltroActas);
        alerta = new AlertDialog.Builder(getContext());
        actasJsons1 = new ArrayList<>();
        recyclerActas = view.findViewById(R.id.recyclerActas);
        txtFechaActasHasta = view.findViewById(R.id.txtFechaActasHasta);
        actasRecientes = new ArrayList<>();
        progressBar = view.findViewById(R.id.progresBarActas);


    }

    private void llenar() {
        alerta = new AlertDialog.Builder(getContext());
        txtFechaActasHasta.setEnabled(false);
        actasRecientes = Login.actasJsons;


        if (Login.actasJsons.size() == 0) {
            alerta.setTitle("INFORMACIÓN");
            alerta.setMessage("Usted no ha registrado ningún acta hasta el momento");
            alerta.setPositiveButton("Aceptar", new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    dialog.cancel();
                }
            });
            alerta.create();
            alerta.show();
        } else {

            item = R.layout.item_list_novedades_recientes;


            final AdapterActas adapterActas = new AdapterActas(Login.actasJsons);

            recyclerActas.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));
            recyclerActas.setHasFixedSize(true);
            recyclerActas.setAdapter(adapterActas);


            adapterActas.setMlistener(new AdapterActas.OnClickListener() {

                public void itemClick(final int position, final View itemView) {

                    //verNovedades.clear();
                    detallesActas.clear();


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

                        String id = Login.actasJsons.get(position).getIdacta();
                        ArrayList<ActasJson> tmplista = Login.actasJsons;

                        for (int i = 0; i < tmplista.size(); i++) {
                            ActasJson ini = tmplista.get(i);
                            if (id.equals(Integer.toString(Integer.parseInt(ini.getIdacta())))) {

                                DetalleActas detalleActas1 = new DetalleActas();
                                detalleActas1.setAmbiente(tmplista.get(i).getNombreambiente());
                                detalleActas1.setEquipo(tmplista.get(i).getNombreequipo());
                                detalleActas1.setFicha(tmplista.get(i).getNumeroficha());
                                detalleActas1.setNombre(tmplista.get(i).getNombreaprendiz());
                                detallesActas.add(detalleActas1);
                                //Toast.makeText(getContext(), verNovedades.get(i).getTipoarticulo(), Toast.LENGTH_SHORT).show();


                            }
                        }

                        Constants.bandera = true;
                        final Dialog dialog = new Dialog(getContext());
                        dialog.setContentView(R.layout.popup_novedades);
                        //dialog.getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
                        TextView txtAmbiente = dialog.findViewById(R.id.txtArticulo);
                        TextView txtFicha = dialog.findViewById(R.id.txtTipoNovedad);
                        TextView txtEquipo = dialog.findViewById(R.id.txtEquipo);
                        TextView txtNombre = dialog.findViewById(R.id.txtJornada);

                        txtAmbiente.setText("AMBIENTE");
                        txtFicha.setText("FICHA");
                        txtNombre.setText("NOMBRE");


                        recyclerArticulos = dialog.findViewById(R.id.recyclerViewArticulos);
                        recyclerArticulos.setLayoutManager(new LinearLayoutManager(dialog.getContext(), LinearLayoutManager.VERTICAL, false));
                        recyclerArticulos.setHasFixedSize(true);
                        AdapterDetalleActas adapterDetalleActas = new AdapterDetalleActas(detallesActas);
                        recyclerArticulos.setAdapter(adapterDetalleActas);


                        dialog.setCancelable(true);

                        dialog.show();


                    }
                }

            });


        }
    }

    private void actualizar() {
        progressBar.setVisibility(View.VISIBLE);
        getActivity().getWindow().setFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE,
                WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);
        getActivity().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
        queue = Volley.newRequestQueue(getContext());
        clase = new ActasRecientes();
        String url = Constants.url+"loginActas/" + Login.iniciarSesionJson.get(0);

        final StringRequest actas = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                Type type = new TypeToken<List<ActasJson>>() {
                }.getType();
                Login.actasJsons = gson.fromJson(response, type);

                Toast.makeText(getContext(), "Lista de Actas actualizada correctamente", Toast.LENGTH_SHORT).show();

                FragmentTransaction ft = getFragmentManager().beginTransaction();
                ft.detach(ActasRecientes.this).attach(ActasRecientes.this).commit();
                progressBar.setVisibility(View.INVISIBLE);
                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);


            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getContext(), "Error de conexión. Inténtelo nuevamente", Toast.LENGTH_SHORT).show();
                progressBar.setVisibility(View.INVISIBLE);
                getActivity().getWindow().clearFlags(WindowManager.LayoutParams.FLAG_NOT_TOUCHABLE);

            }
        });
        queue.add(actas);
    }

}