package com.example.demo;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class AddressController {
    private final List<Address> addresses = new ArrayList<Address>(Arrays.asList(
            new Address("38406-633", "Avenida Cesário Alvim", "Granja Marileusa", "Uberlândia"),
            new Address("38406-389", "Rua Himalaia", "Mansões Aeroporto", "Uberlândia"),
            new Address("38411-106", "Avenida Nicomedes Alves dos Santos", "Morada da Colina", "Uberlândia")));

    @GetMapping("/hello")
    public String helloWorld() {
        return "Hello World!";
    }

    @GetMapping("/address")
    // retorna a lista de endereços com uma resposta HTTP 200
    public ResponseEntity<List<Address>> getAddresses() {
        // return ResponseEntity.ok(this.addresses);
        // return this.addresses;
        return new ResponseEntity<List<Address>>(this.addresses, HttpStatus.OK);
    }

    @GetMapping("/address/{cep}")
    public ResponseEntity<Address> getAddress(@PathVariable String cep) {
        for (Address address : this.addresses) {
            if (address.getCep().equals(cep)) {
                // return ResponseEntity.ok(address);
                return new ResponseEntity<Address>(address, HttpStatus.OK);
            }
        }
        // return ResponseEntity.notFound().build();
        return new ResponseEntity<Address>(HttpStatus.NOT_FOUND);
    }

    @PostMapping("/address")
    public ResponseEntity<Address> createAddress(@RequestBody Address address) {
        this.addresses.add(address);
        return new ResponseEntity<Address>(address, HttpStatus.CREATED);
    }

    @DeleteMapping("/address/{cep}")
    public ResponseEntity<Address> deleteAddress(@PathVariable String cep) {
        for (Address address : this.addresses) {
            if (address.getCep().equals(cep)) {
                this.addresses.remove(address);
                return new ResponseEntity<Address>(address, HttpStatus.OK);
            }
        }
        return new ResponseEntity<Address>(HttpStatus.NOT_FOUND);
    }
}
