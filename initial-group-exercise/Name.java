//Comment By Austin
//Comment By Kiley
//Commetn By Matt

public class Name {
    private String title;
    private String first;
    private String middle;
    private String surname;
    private String surnameParent1;
    private String surnameParent2;
    private String suffixGenerational; // e.g., III, Jr., Sr., etc.
    private String suffixProfessional; // e.g., Ph.D., CPA, etc.

    public Name (
            String title,
            String first,
            String middle,
            String surname,
            String surnameParent1,
            String surnameParent2,
            String generational,
            String professional
            ) {
        this.title = title;
        this.first = first;
        this.middle = middle;
        this.surname = surname;
        this.surnameParent1 = surnameParent1;
        this.surnameParent2 = surnameParent2;
        this.suffixGenerational = generational;
        this.suffixProfessional = professional;
    }

    public String getTitle() {
        return this.title;
    }

    public String getFirst() {
        return this.first;
    }

    public String getMiddle() {
        return this.middle;
    }

    public String getSurname() {
        return this.surname;
    }

    public String getSurnameParent1() {
        return this.surnameParent1; 
    }

    public String getSurnameParent2() {
        return this.surnameParent2;
    }

    public String getSuffixProfessional() {
        return this.suffixProfessional; 
    }

    public String getSuffixGenerational() {
        return this.suffixGenerational;
    }
}
