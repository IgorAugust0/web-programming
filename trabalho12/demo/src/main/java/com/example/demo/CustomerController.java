package com.example.demo;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import org.springframework.web.bind.annotation.GetMapping;
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

    public Customer getCustomerByCpf(String cpf) {
        for (Customer customer : this.customers) {
            if (customer.getCpf().equals(cpf)) {
                return customer;
            }
        }
        return null;
    }
}
