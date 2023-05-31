package com.example.demo;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class CustomerController {
    private List<Customer> customers = new ArrayList<>(
        Arrays.asList(
            new Customer("12345678900", "João", "123456789"),
            new Customer("98765432100", "Maria", "987654321"),
            new Customer("12312312300", "José", "123123123")
        )
    );
    @GetMapping("/hello") 
    public String helloWorld() {
        return "Hello World!";
    }

    @GetMapping("/customers")
    public List<Customer> getCustomers() {
        return this.customers;
    }

    @GetMapping("/customers/{cpf}")
    // retorna o primeiro customer encontrado com o cpf informado com uma resposta HTTP 200
    // caso não encontre, retorna uma resposta HTTP 404
    public ResponseEntity<Customer> getCustomerByCpf(@PathVariable String cpf) {
        for (Customer customer : this.customers) {
            if (customer.getCpf().equals(cpf)) {
                // return ResponseEntity.ok(customer);
                return new ResponseEntity<Customer>(customer, HttpStatus.OK);
            }
        }
        // return ResponseEntity.notFound().build();
        return new ResponseEntity<Customer>(HttpStatus.NOT_FOUND);
    }
}
