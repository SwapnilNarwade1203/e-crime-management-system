import java.util.Scanner;

class Product {
    // Static variable to keep track of the total amount
    static double total = 0.0;

    private String pid;
    private String pname;
    private double price;

   
    public Product(String pid, String pname, double price) {
        this.pid = pid;
        this.pname = pname;
        this.price = price;
        total += price; 
    }

    public void displayDetails() {
        System.out.println("Product ID: " + pid);
        System.out.println("Product Name: " + pname);
        System.out.printf("Product Price: $%.2f\n", price);
    }


    public static double getTotal() {
        return total;
    }
}

public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        System.out.print("How many products do you want to enter? ");
        int n = scanner.nextInt();
        scanner.nextLine(); // Consume the newline

        Product[] products = new Product[n]; // Array to hold Product objects

        for (int i = 0; i < n; i++) {
            System.out.print("Enter Product ID: ");
            String pid = scanner.nextLine();
            System.out.print("Enter Product Name: ");
            String pname = scanner.nextLine();
            System.out.print("Enter Product Price: ");
            double price = scanner.nextDouble();
            scanner.nextLine(); // Consume the newline

            products[i] = new Product(pid, pname, price); // Create new product
        }

        System.out.println("\nProduct Details:");
        for (int i = 0; i < n; i++) {
            product[i].displayDetails();
        }

        System.out.printf("\nTotal Amount: $%.2f\n", Product.getTotal());
        scanner.close();
    }
}
