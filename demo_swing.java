import javax.swing.*;
import java.awt.event.*;
class demo_swing implements ActionListener{
    static JTextField t1,t2,t3;
    JFrame f;
    public static void main(String args[]){
        demo_swing d1= new demo_swing();
    }
    demo_swing(){
        f=new JFrame("CONCAT text");
        JLabel l1= new JLabel("text1: ");
        l1.setBounds(10,50,20,30);
        t1=new JTextField();
        t1.setBounds(10,50,30,20);
        t2=new JTextField();
        t2.setBounds(10,50,30,20);
        JLabel l2= new JLabel("text2: ");
        l2.setBounds(10,50,20,30);
        add(t1);
        add(t2);
        add(l1);
        add(l2);
        b.addActionListener(this);
        f.add(b);
        f.setSize(500,500);
        f.setLayout(Null);
        f.setVisible(true);

    }
    public static void ActionPerfromed(ActionEvent e){
        String s1,s2;
        s1=t1.getText();
        s2=t2.getText();
        t3.setText(s1+""+s2);

    }
}